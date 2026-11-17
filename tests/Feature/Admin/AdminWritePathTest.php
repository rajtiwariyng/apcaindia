<?php

namespace Tests\Feature\Admin;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * End-to-end WRITE-path verification against the real apca_india DB.
 *
 * Everything runs inside a manual transaction that is rolled back in tearDown,
 * so no test data persists. The one filesystem side effect (an uploaded file)
 * is deleted explicitly.
 *
 * CSRF is skipped automatically by Laravel's VerifyCsrfToken during tests.
 */
class AdminWritePathTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'database.default' => 'mysql',
            'database.connections.mysql.host' => '127.0.0.1',
            'database.connections.mysql.database' => 'apca_india',
            'database.connections.mysql.username' => 'root',
            'database.connections.mysql.password' => '',
        ]);

        DB::connection('mysql')->beginTransaction();
    }

    protected function tearDown(): void
    {
        DB::connection('mysql')->rollBack();

        parent::tearDown();
    }

    /**
     * The real login path: users table + md5(). Credentials are read from env
     * (SMOKE_ADMIN_EMAIL / SMOKE_ADMIN_PASSWORD) so none are committed; the test
     * skips when they are not provided.
     */
    public function test_admin_can_log_in_with_real_credentials(): void
    {
        $email = env('SMOKE_ADMIN_EMAIL');
        $password = env('SMOKE_ADMIN_PASSWORD');

        if (! $email || ! $password) {
            $this->markTestSkipped('Set SMOKE_ADMIN_EMAIL / SMOKE_ADMIN_PASSWORD to run the live login check.');
        }

        $this->post('/admin/login_check', compact('email', 'password'))
            ->assertOk()->assertJson(['status' => '200']);

        $this->assertNotNull(session('sessionadmin'));
        $this->assertSame($email, session('sessionadmin')['email']);
    }

    /** Bad password must be rejected. */
    public function test_admin_login_rejects_wrong_password(): void
    {
        $email = env('SMOKE_ADMIN_EMAIL');

        if (! $email) {
            $this->markTestSkipped('Set SMOKE_ADMIN_EMAIL to run the live login check.');
        }

        $this->post('/admin/login_check', ['email' => $email, 'password' => 'definitely-wrong'])
            ->assertOk()->assertJson(['status' => '401']);
    }

    private function asAdmin(): static
    {
        return $this->withSession(['sessionadmin' => [
            'userid' => 1, 'name' => 'superadmin', 'email' => 'superadmin@gmail.com',
        ]]);
    }

    /** Full create -> update -> status -> delete cycle on Testimonial (no upload). */
    public function test_testimonial_create_update_status_delete(): void
    {
        // CREATE
        $this->asAdmin()->post('/admin/testimonial/addupdatetestimonial', [
            'name' => 'SMOKE_TEST_NAME',
            'program' => 'Smoke Program',
            'blogdescription' => 'Smoke description',
            'image_name' => '',
            'imagePath' => '',
            'uniqueid' => '',
            'publishingStatus' => '1',
            'home' => '1',
        ])->assertOk()->assertJson(['status' => '200', 'msg' => 'Testimonial created successfully.']);

        $row = DB::table('tbl_testimonial')->where('name', 'SMOKE_TEST_NAME')->first();
        $this->assertNotNull($row, 'Testimonial row was created');
        $this->assertSame('Smoke Program', $row->program);

        // UPDATE
        $this->asAdmin()->post('/admin/testimonial/addupdatetestimonial', [
            'name' => 'SMOKE_TEST_UPDATED',
            'program' => 'Smoke Program 2',
            'blogdescription' => 'Smoke description 2',
            'image_name' => '',
            'imagePath' => '',
            'uniqueid' => $row->uniqueid,
            'publishingStatus' => '1',
            'home' => '0',
        ])->assertOk()->assertJson(['status' => '200', 'msg' => 'Testimonial updated successfully.']);

        $this->assertSame('SMOKE_TEST_UPDATED', DB::table('tbl_testimonial')->where('uniqueid', $row->uniqueid)->value('name'));

        // STATUS TOGGLE (JSON body, as the front-end sends it)
        $this->asAdmin()->postJson('/admin/testimonial_status', ['id' => $row->uniqueid, 'status' => '0']);
        $this->assertSame('0', (string) DB::table('tbl_testimonial')->where('uniqueid', $row->uniqueid)->value('status'));

        // DELETE (JSON body, as the front-end sends it)
        $this->asAdmin()->postJson('/admin/deletetestimonialdata', [
            'useridd' => $row->uniqueid,
            'table' => 'tbl_testimonial',
            'colmn' => 'uniqueid',
        ])->assertOk()->assertJson(['status' => '200', 'msg' => 'Data successfully deleted.']);

        $this->assertNull(DB::table('tbl_testimonial')->where('uniqueid', $row->uniqueid)->first(), 'Testimonial row was deleted');
    }

    /** Image upload path through ImageUploadService. */
    public function test_testimonial_image_upload_stores_file(): void
    {
        $file = UploadedFile::fake()->create('smoke-upload.jpg', 50, 'image/jpeg');

        $this->asAdmin()->post('/admin/testimonial/addupdatetestimonial', [
            'name' => 'SMOKE_UPLOAD',
            'program' => 'P',
            'blogdescription' => 'D',
            'image_name' => 'new',
            'imagePath' => 'old',     // differs -> triggers a real upload
            'uniqueid' => '',
            'publishingStatus' => '1',
            'home' => '0',
            'imageidd' => $file,
        ])->assertOk()->assertJson(['status' => '200']);

        $stored = DB::table('tbl_testimonial')->where('name', 'SMOKE_UPLOAD')->value('image');
        $this->assertNotEmpty($stored);
        $this->assertStringEndsWith('_smoke-upload.jpg', $stored);

        $path = public_path('assets/upload/testimonial/'.$stored);
        $this->assertFileExists($path, 'Uploaded file landed in public/assets/upload/testimonial');

        @unlink($path); // clean up the filesystem side effect (DB row rolls back)
    }
}
