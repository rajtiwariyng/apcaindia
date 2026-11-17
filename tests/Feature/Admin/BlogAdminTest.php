<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;

/**
 * Behavior-parity checks for the ported admin Blog module.
 *
 * These run READ-ONLY against the real legacy database (apca_india) — no
 * RefreshDatabase, no writes — so they validate the ported Eloquent/view layer
 * against the actual production schema and data.
 */
class BlogAdminTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // phpunit.xml pins the suite to in-memory sqlite; point these specific
        // tests back at the live MySQL schema (read-only).
        config([
            'database.default' => 'mysql',
            'database.connections.mysql.host' => '127.0.0.1',
            'database.connections.mysql.database' => 'apca_india',
            'database.connections.mysql.username' => 'root',
            'database.connections.mysql.password' => '',
        ]);
    }

    public function test_listing_redirects_to_login_when_unauthenticated(): void
    {
        $this->get('/admin/blog/bloglisting')->assertRedirect('/admin-login');
    }

    public function test_listing_renders_when_authenticated(): void
    {
        $this->withSession(['sessionadmin' => [
            'userid' => 1,
            'name' => 'Test Admin',
            'email' => 'test@example.com',
        ]])
            ->get('/admin/blog/bloglisting')
            ->assertOk();
    }

    public function test_create_page_renders_when_authenticated(): void
    {
        $this->withSession(['sessionadmin' => [
            'userid' => 1,
            'name' => 'Test Admin',
            'email' => 'test@example.com',
        ]])
            ->get('/admin/blog/createnewblog')
            ->assertOk();
    }
}
