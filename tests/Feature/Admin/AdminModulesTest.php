<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;

/**
 * Render + auth checks for the ported admin CRUD modules (batch 2).
 *
 * READ-ONLY against the real apca_india DB (no RefreshDatabase / no writes).
 */
class AdminModulesTest extends TestCase
{
    /** @var array<string,array{0:string,1:string}> module => [listingUrl, createUrl] */
    private array $modules = [
        'testimonial' => ['/admin/testimonial/listing', '/admin/testimonial/createtestimonial'],
        'placementpartners' => ['/admin/placementpartners/listing', '/admin/placementpartners/create'],
        'supportingbrands' => ['/admin/supportingbrands/listing', '/admin/supportingbrands/create'],
        'alumni' => ['/admin/alumni/listing', '/admin/alumni/create'],
        'chefeducators' => ['/admin/chefeducators/listing', '/admin/chefeducators/create'],
        'gallery' => ['/admin/gallery/listing', '/admin/gallery/creategallery'],
        'faqs' => ['/admin/faqs/listing', '/admin/faqs/create'],
        'homeprogram' => ['/admin/homeprogram/listing', '/admin/homeprogram/create'],
        'bannervideo' => ['/admin/bannervideo/listing', '/admin/bannervideo/create'],
        'pdf' => ['/admin/pdf/listing', '/admin/pdf/create'],
        'pages' => ['/admin/pages/listing', '/admin/pages/create'],
        'homeslider' => ['/admin/homeslider/listing', '/admin/homeslider/create'],
        'studentsection' => ['/admin/studentsection/listing', '/admin/studentsection/create'],
        'blogcategory' => ['/admin/blogcategory/listing', '/admin/blogcategory/create'],
        'coursepage' => ['/admin/coursepage/listing', '/admin/coursepage/create'],
        'coursemodule' => ['/admin/coursemodule/listing', '/admin/coursemodule/create'],
        'intprogram' => ['/admin/intprogram/listing', '/admin/intprogram/create'],
        'intprogrampage' => ['/admin/intprogrampage/listing', '/admin/intprogrampage/create'],
    ];

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
    }

    private function asAdmin(): static
    {
        return $this->withSession(['sessionadmin' => [
            'userid' => 1, 'name' => 'Test Admin', 'email' => 'test@example.com',
        ]]);
    }

    public function test_all_module_listings_render_when_authenticated(): void
    {
        foreach ($this->modules as $name => [$listing, $create]) {
            $this->asAdmin()->get($listing)->assertOk();
        }
    }

    public function test_all_module_create_pages_render_when_authenticated(): void
    {
        foreach ($this->modules as $name => [$listing, $create]) {
            $this->asAdmin()->get($create)->assertOk();
        }
    }

    public function test_all_module_listings_redirect_when_unauthenticated(): void
    {
        foreach ($this->modules as $name => [$listing, $create]) {
            $this->get($listing)->assertRedirect('/admin-login');
        }
    }

    public function test_contact_enquiry_pages_render_when_authenticated(): void
    {
        $this->asAdmin()->get('/admin/contactus')->assertOk();
        $this->asAdmin()->get('/admin/contact-download')->assertOk();
    }

    public function test_contact_enquiry_redirects_when_unauthenticated(): void
    {
        $this->get('/admin/contactus')->assertRedirect('/admin-login');
    }
}
