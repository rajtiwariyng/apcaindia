<?php

/*
|--------------------------------------------------------------------------
| Old-URL redirects (301)
|--------------------------------------------------------------------------
| Registered in routes/web.php. See docs/BLOG.md and docs/STATUS.md.
|
| blog_slugs : old WordPress post_name => new slug. The blog import removed underscores/odd
|              characters from these 13 slugs, so the old URLs would 404 without a redirect.
| blog_list_prefixes : old WordPress listing URLs with no equivalent on the new site -> /blog.
*/

return [

    'blog_slugs' => [
        'academy-of-culinary-arts-bangalore-blogs_cooking-with-your-heart' => 'academy-of-culinary-arts-bangalore-blogscooking-with-your-heart',
        'academy-of-culinary-arts-bangalore-blogs_features-of-a-topnotch-culinary-school' => 'academy-of-culinary-arts-bangalore-blogsfeatures-of-a-topnotch-culinary-school',
        'academy-of-culinary-arts-bangalore-blogspot_man-or-woman-whos-the-better-cook' => 'academy-of-culinary-arts-bangalore-blogspotman-or-woman-whos-the-better-cook',
        'academy-of-culinary-arts-bangalore-blogspot_learning-cooking-through-recipe-books' => 'academy-of-culinary-arts-bangalore-blogspotlearning-cooking-through-recipe-books',
        'academy-of-culinary-arts-bangalore-blogs_a-lot-can-happen-over-a-dinner' => 'academy-of-culinary-arts-bangalore-blogsa-lot-can-happen-over-a-dinner',
        'academy-of-culinary-arts-bangalore-blogs_some-seafood-on-my-platter' => 'academy-of-culinary-arts-bangalore-blogssome-seafood-on-my-platter',
        'academy-of-culinary-arts-bangalore-blogs_dhaba-the-understated-but-much-sought-after-indian-eatery' => 'academy-of-culinary-arts-bangalore-blogsdhaba-the-understated-but-much-sought-after-indian-eatery',
        'academy-of-culinary-arts-bangalore-blogs_the-tiffin-period-and-nostalgia-attached-to-it' => 'academy-of-culinary-arts-bangalore-blogsthe-tiffin-period-and-nostalgia-attached-to-it',
        'academy-of-culinary-arts-bangalore-blogs_my-first-cooking-class' => 'academy-of-culinary-arts-bangalore-blogsmy-first-cooking-class',
        'academy-of-culinary-arts-bangalore-blogs_-north-and-south-unity-in-diversity' => 'academy-of-culinary-arts-bangalore-blogs-north-and-south-unity-in-diversity',
        'academy-of-culinary-arts-bangalore-blogs-_-big-dreams-of-a-small-town-boy' => 'academy-of-culinary-arts-bangalore-blogs--big-dreams-of-a-small-town-boy',
        'academy-of-culinary-arts-bangalore-blogs_delicious-vegetarian-food-for-everyone' => 'academy-of-culinary-arts-bangalore-blogsdelicious-vegetarian-food-for-everyone',
        'academy-of-culinary-arts-bangalore-blogs_-how-culinary-schools-evolved-in-india' => 'academy-of-culinary-arts-bangalore-blogs-how-culinary-schools-evolved-in-india',
    ],

    'blog_list_prefixes' => ['category', 'author', 'page', 'tag'],

];
