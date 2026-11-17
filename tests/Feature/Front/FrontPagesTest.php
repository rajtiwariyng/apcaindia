<?php

namespace Tests\Feature\Front;

use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Smoke test for the public (front-end) pages against the real apca_india DB.
 *
 * A manual transaction (begun AFTER the mysql connection is configured) wraps
 * each test and is rolled back in tearDown, so the page_views inserts the front
 * controllers perform never pollute the database.
 */
class FrontPagesTest extends TestCase
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

    /** @return array<int, array<int, string>> */
    public static function publicUrls(): array
    {
        return array_map(fn ($u) => [$u], [
            '/', '/contact-us', '/about-us', '/faq', '/blog', '/blog-listing',
            '/courses', '/gallery', '/apca-alumni', '/chef-educators',
            '/international-paid-internship', '/academy-resource',
            '/message-from-founder', '/terms-and-conditions',
            '/bangalore', '/gurgaon', '/mumbai', '/delhi',
        ]);
    }

    #[DataProvider('publicUrls')]
    public function test_public_page_renders(string $url): void
    {
        $this->get($url)->assertOk();
    }

    public function test_course_detail_renders(): void
    {
        $slug = DB::table('courses')->where('status', 1)->where('slug', '<>', '')->value('slug');

        if ($slug) {
            $this->get('/course/'.$slug)->assertOk();
        }
    }

    public function test_blog_detail_renders(): void
    {
        $slug = DB::table('tbl_blog')->where('status', 1)->where('slug', '<>', '')->value('slug');

        if ($slug) {
            $this->get('/blog/'.$slug)->assertOk();
        }
    }
}
