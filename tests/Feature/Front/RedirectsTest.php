<?php

namespace Tests\Feature\Front;

use Tests\TestCase;

/**
 * Old WordPress blog URLs -> new URLs (config/redirects.php). No database needed: redirects are routes.
 */
class RedirectsTest extends TestCase
{
    public function test_changed_blog_slugs_redirect_permanently_to_the_new_slug(): void
    {
        $map = config('redirects.blog_slugs');
        $this->assertCount(13, $map);

        foreach ($map as $old => $new) {
            $this->get('/blog/'.$old)->assertStatus(301)->assertRedirect('/blog/'.$new);
        }
    }

    public function test_old_blog_listing_urls_redirect_to_the_blog_index(): void
    {
        foreach (['/blog/category/uncategorized', '/blog/author/admin', '/blog/page/2', '/blog/page/16', '/blog/tag/baking', '/blog/category/a/b'] as $url) {
            $this->get($url)->assertStatus(301)->assertRedirect('/blog');
        }
    }
}
