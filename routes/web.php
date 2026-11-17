<?php

use App\Http\Controllers\Front\AboutusController;
use App\Http\Controllers\Front\BlogpageController;
use App\Http\Controllers\Front\CategoriesController;
use App\Http\Controllers\Front\ContactusController;
use App\Http\Controllers\Front\CoursesController;
use App\Http\Controllers\Front\FooterController;
use App\Http\Controllers\Front\HeaderController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public (front-end) routes
|--------------------------------------------------------------------------
| Ported from the legacy per-module route files. URLs preserved exactly.
*/

Route::get('/', [HomeController::class, 'home']);

// Header / footer partial endpoints + newsletter subscribe
Route::get('header', [HeaderController::class, 'welcome']);
Route::get('footer', [FooterController::class, 'welcome']);
Route::post('/subscribe', [FooterController::class, 'subscribe'])->name('subscribe');

// Contact us
Route::get('contact-us', [ContactusController::class, 'contactus']);
Route::post('/contact-us/store', [ContactusController::class, 'submitForm'])->name('submit.form');

// Blog
Route::get('blog', [BlogpageController::class, 'blog']);
Route::get('blog-listing', [BlogpageController::class, 'blog']);
Route::get('/search-posts', [BlogpageController::class, 'search'])->name('search.posts');
Route::get('blog/{slug}', [BlogpageController::class, 'blogDetails']);
Route::get('international-paid-internship/{slug}', [BlogpageController::class, 'intprogrampageDetails']);

// Courses
Route::get('courses', [CoursesController::class, 'courses']);
Route::get('course/{slug}', [CoursesController::class, 'courseDetails']);
Route::get('/track-pdf-download/{id}', [CoursesController::class, 'download'])->name('track.pdf.download');

// Categories (queries a table not present locally — see controller note)
Route::get('categories/{category}', [CategoriesController::class, 'getCategoryPage']);
Route::get('{currency}/categories/{category}', [CategoriesController::class, 'getCategoryPageCurrency']);

// About-us cluster
Route::get('about-us', [AboutusController::class, 'explore']);
Route::get('achivements', [AboutusController::class, 'achivements']);
Route::get('achivements-gallery', [AboutusController::class, 'achivementsGallery']);
Route::get('faculty', [AboutusController::class, 'faculty']);
Route::get('academy-resource', [AboutusController::class, 'academy']);
Route::get('international-paid-internship', [AboutusController::class, 'internationalPaidInternship']);
Route::get('faq', [AboutusController::class, 'faq']);
Route::get('career', [AboutusController::class, 'career']);
Route::get('accomodation', [AboutusController::class, 'accomodation']);
Route::get('online-registration', [AboutusController::class, 'onlineRegistration']);
Route::get('recipe-and-inspiration', [AboutusController::class, 'recipeAndInspiration']);
Route::get('pay-now', [AboutusController::class, 'paynow']);
Route::get('privacy-policy', [AboutusController::class, 'privacypolicy']);
Route::get('terms-and-conditions', [AboutusController::class, 'termsandconditions']);
Route::get('gallery', [AboutusController::class, 'gallery']);
Route::get('news', [AboutusController::class, 'news']);
Route::get('news-details', [AboutusController::class, 'newsDetails']);
Route::get('message-from-founder', [AboutusController::class, 'messageFromFounder']);
Route::get('awards-accolades', [AboutusController::class, 'AwardsAccolades']);
Route::get('admission', [AboutusController::class, 'admission']);
Route::get('career-opportunities', [AboutusController::class, 'careerOpportunities']);
Route::get('industrial-visit', [AboutusController::class, 'industrialVisit']);
Route::get('recipes-and-inspiration', [AboutusController::class, 'recipesAndInspiration']);
Route::get('chef-educators', [AboutusController::class, 'chefEducator']);
Route::get('apca-alumni', [AboutusController::class, 'apcaAlumni']);
Route::get('apca-programs', [AboutusController::class, 'apcaPrograms']);
Route::get('program-flyers', [AboutusController::class, 'programFlyers']);
Route::get('academic-intake-calendar', [AboutusController::class, 'academicIntakeCalendar']);
Route::get('program-application', [AboutusController::class, 'programApplication']);
Route::get('visit-the-academy', [AboutusController::class, 'visitTheAcademy']);
Route::get('bangalore', [AboutusController::class, 'bangalore']);
Route::get('gurgaon', [AboutusController::class, 'gurgaon']);
Route::get('mumbai', [AboutusController::class, 'mumbai']);
Route::get('delhi', [AboutusController::class, 'delhi']);
