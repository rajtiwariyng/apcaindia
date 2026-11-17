<?php

use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannervideoController;
use App\Http\Controllers\Admin\BlogcategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ChefeducatorsController;
use App\Http\Controllers\Admin\ContactEnquiryController;
use App\Http\Controllers\Admin\CoursemoduleController;
use App\Http\Controllers\Admin\CoursepageController;
use App\Http\Controllers\Admin\HomesliderController;
use App\Http\Controllers\Admin\IntprogrampageController;
use App\Http\Controllers\Admin\IntprogramController;
use App\Http\Controllers\Admin\StudentsectionController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomeprogramController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\PdfController;
use App\Http\Controllers\Admin\PlacementpartnersController;
use App\Http\Controllers\Admin\SupportingbrandsController;
use App\Http\Controllers\Admin\TestimonialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin routes (ported from the legacy Admin module web.php)
|--------------------------------------------------------------------------
|
| URLs are preserved exactly so existing links/AJAX continue to work.
|
| SECURITY CHANGE (flagged for confirmation): in the legacy app the status-
| toggle and delete endpoints had NO authentication check inside their methods,
| so they were callable by unauthenticated users. They are now inside the
| `auth.admin` group below. This is an intentional security fix, not a UI change.
*/

// --- Public admin auth ------------------------------------------------------
Route::get('/admin-login', [AuthController::class, 'login']);
Route::post('/admin/login_check', [AuthController::class, 'loginCheck']);
Route::get('/admin/logout', [AuthController::class, 'logout']);

// --- Authenticated admin ----------------------------------------------------
Route::middleware('auth.admin')->group(function () {
    Route::get('/admin/dashboard', [AuthController::class, 'dashboard']);

    // Contact enquiries (list + export)
    Route::get('/admin/contactus', [ContactEnquiryController::class, 'index']);
    Route::get('/admin/contact-download', [ContactEnquiryController::class, 'download']);

    // Blog
    Route::get('/admin/blog/createnewblog', [BlogController::class, 'createnewblog']);
    Route::get('/admin/blog/createnewblog/{url?}', [BlogController::class, 'updateblog']);
    Route::post('/admin/addbloginfo', [BlogController::class, 'addbloginfo']);
    Route::get('/admin/blog/bloglisting/{d?}', [BlogController::class, 'bloglisting']);
    Route::post('/admin/deleteblogdata', [BlogController::class, 'deleteblogdata']);
    Route::post('/admin/blog/change_status', [BlogController::class, 'change_status']);

    // Testimonial
    Route::get('/admin/testimonial/listing/{d?}', [TestimonialController::class, 'listing']);
    Route::get('/admin/testimonial/createtestimonial', [TestimonialController::class, 'createtestimonial']);
    Route::get('/admin/testimonial/createtestimonial/{url?}', [TestimonialController::class, 'edittestimonial']);
    Route::post('/admin/testimonial/addupdatetestimonial', [TestimonialController::class, 'addupdatetestimonial']);
    Route::post('/admin/testimonial_status', [TestimonialController::class, 'changeStatus']);
    Route::post('/admin/deletetestimonialdata', [TestimonialController::class, 'deleteData']);

    // Placement partners
    Route::get('/admin/placementpartners/listing/{d?}', [PlacementpartnersController::class, 'listing']);
    Route::get('/admin/placementpartners/create', [PlacementpartnersController::class, 'createplacementpartners']);
    Route::get('/admin/placementpartners/create/{url?}', [PlacementpartnersController::class, 'editplacementpartners']);
    Route::post('/admin/placementpartners/addupdate', [PlacementpartnersController::class, 'addupdateplacementpartners']);
    Route::post('/admin/placementpartners_status', [PlacementpartnersController::class, 'changeStatus']);
    Route::post('/admin/deleteplacementpartnersdata', [PlacementpartnersController::class, 'deleteData']);

    // Supporting brands
    Route::get('/admin/supportingbrands/listing/{d?}', [SupportingbrandsController::class, 'listing']);
    Route::get('/admin/supportingbrands/create', [SupportingbrandsController::class, 'createsupportingbrands']);
    Route::get('/admin/supportingbrands/create/{url?}', [SupportingbrandsController::class, 'editsupportingbrands']);
    Route::post('/admin/supportingbrands/addupdate', [SupportingbrandsController::class, 'addupdatesupportingbrands']);
    Route::post('/admin/supportingbrands_status', [SupportingbrandsController::class, 'changeStatus']);
    Route::post('/admin/deletesupportingbrands', [SupportingbrandsController::class, 'deleteData']);

    // Alumni
    Route::get('/admin/alumni/listing/{d?}', [AlumniController::class, 'listing']);
    Route::get('/admin/alumni/create', [AlumniController::class, 'createalumni']);
    Route::get('/admin/alumni/create/{url?}', [AlumniController::class, 'editalumni']);
    Route::post('/admin/alumni/addupdate', [AlumniController::class, 'addupdatealumni']);
    Route::post('/admin/alumni_status', [AlumniController::class, 'changeStatus']);
    Route::post('/admin/deletealumni', [AlumniController::class, 'deleteData']);

    // Chef educators
    Route::get('/admin/chefeducators/listing/{d?}', [ChefeducatorsController::class, 'listing']);
    Route::get('/admin/chefeducators/create', [ChefeducatorsController::class, 'createchefeducators']);
    Route::get('/admin/chefeducators/create/{url?}', [ChefeducatorsController::class, 'editchefeducators']);
    Route::post('/admin/chefeducators/addupdate', [ChefeducatorsController::class, 'addupdatechefeducators']);
    Route::post('/admin/chefeducators_status', [ChefeducatorsController::class, 'changeStatus']);
    Route::post('/admin/deletechefeducators', [ChefeducatorsController::class, 'deleteData']);

    // Photo gallery
    Route::get('/admin/gallery/listing/{d?}', [GalleryController::class, 'listing']);
    Route::get('/admin/gallery/creategallery', [GalleryController::class, 'creategallery']);
    Route::get('/admin/gallery/creategallery/{url?}', [GalleryController::class, 'editgallery']);
    Route::post('/admin/gallery/addupdategallery', [GalleryController::class, 'addupdategallery']);
    Route::post('/admin/gallery_status', [GalleryController::class, 'changeStatus']);
    Route::post('/admin/deletephotogallery', [GalleryController::class, 'deleteData']);

    // FAQs
    Route::get('/admin/faqs/listing/{d?}', [FaqsController::class, 'listing']);
    Route::get('/admin/faqs/create', [FaqsController::class, 'createfaqs']);
    Route::get('/admin/faqs/create/{url?}', [FaqsController::class, 'editfaqs']);
    Route::post('/admin/faqs/addupdate', [FaqsController::class, 'addupdatefaqs']);
    Route::post('/admin/faqs_status', [FaqsController::class, 'changeStatus']);
    Route::post('/admin/deletefaqs', [FaqsController::class, 'deleteData']);

    // Home programs
    Route::get('/admin/homeprogram/listing/{d?}', [HomeprogramController::class, 'listing']);
    Route::get('/admin/homeprogram/create', [HomeprogramController::class, 'createhomeprogram']);
    Route::get('/admin/homeprogram/create/{url?}', [HomeprogramController::class, 'edithomeprogram']);
    Route::post('/admin/homeprogram/addupdate', [HomeprogramController::class, 'addupdatehomeprogram']);
    Route::post('/admin/homeprogram_status', [HomeprogramController::class, 'changeStatus']);
    Route::post('/admin/deletehomeprogram', [HomeprogramController::class, 'deleteData']);

    // Banner video
    Route::get('/admin/bannervideo/listing/{d?}', [BannervideoController::class, 'listing']);
    Route::get('/admin/bannervideo/create', [BannervideoController::class, 'createbannervideo']);
    Route::get('/admin/bannervideo/create/{url?}', [BannervideoController::class, 'editbannervideo']);
    Route::post('/admin/bannervideo/addupdate', [BannervideoController::class, 'addupdatebannervideo']);
    Route::post('/admin/bannervideo_status', [BannervideoController::class, 'changeStatus']);
    Route::post('/admin/deletebannervideo', [BannervideoController::class, 'deleteData']);

    // PDF + intake calendar
    Route::get('/admin/pdf/listing/{d?}', [PdfController::class, 'listing']);
    Route::get('/admin/pdf/create', [PdfController::class, 'create']);
    Route::get('/admin/pdf/create/{url?}', [PdfController::class, 'edit']);
    Route::post('/admin/pdf/addupdate', [PdfController::class, 'addupdate']);
    Route::post('/admin/pdf_status', [PdfController::class, 'changeStatus']);
    Route::post('/admin/deletepdf', [PdfController::class, 'deleteData']);
    Route::get('/admin/intakecalender/create/{url?}', [PdfController::class, 'intakecalender']);
    Route::post('/admin/intakecalender/addupdate', [PdfController::class, 'intakecalenderaddupdate']);

    // Pages
    Route::get('/admin/pages/listing/{d?}', [PagesController::class, 'listing']);
    Route::get('/admin/pages/create', [PagesController::class, 'create']);
    Route::get('/admin/pages/create/{url?}', [PagesController::class, 'edit']);
    Route::post('/admin/pages/addupdate', [PagesController::class, 'addupdate']);
    Route::post('/admin/pages_status', [PagesController::class, 'changeStatus']);
    Route::post('/admin/deletepages', [PagesController::class, 'deleteData']);

    // Home slider (+ home content sub-form)
    Route::get('/admin/homeslider/listing/{d?}', [HomesliderController::class, 'listing']);
    Route::get('/admin/homeslider/create', [HomesliderController::class, 'create']);
    Route::get('/admin/homeslider/create/{url?}', [HomesliderController::class, 'edit']);
    Route::post('/admin/homeslider/addupdate', [HomesliderController::class, 'addupdate']);
    Route::post('/admin/homeslider_status', [HomesliderController::class, 'changeStatus']);
    Route::post('/admin/deletehomeslider', [HomesliderController::class, 'deleteData']);
    Route::get('/admin/homeslidercontent/create/{url?}', [HomesliderController::class, 'updatecontent']);
    Route::post('/admin/homeslidercontent/addupdate', [HomesliderController::class, 'contentaddupdate']);

    // Student section (stored in tbl_homeslider, category = student)
    Route::get('/admin/studentsection/listing/{d?}', [StudentsectionController::class, 'listing']);
    Route::get('/admin/studentsection/create', [StudentsectionController::class, 'create']);
    Route::get('/admin/studentsection/create/{url?}', [StudentsectionController::class, 'edit']);
    Route::post('/admin/studentsection/addupdate', [StudentsectionController::class, 'addupdate']);
    Route::post('/admin/studentsection_status', [StudentsectionController::class, 'changeStatus']);
    Route::post('/admin/deletestudentsection', [StudentsectionController::class, 'deleteData']);

    // Blog category
    Route::get('/admin/blogcategory/listing/{d?}', [BlogcategoryController::class, 'listing']);
    Route::get('/admin/blogcategory/create', [BlogcategoryController::class, 'create']);
    Route::get('/admin/blogcategory/create/{url?}', [BlogcategoryController::class, 'edit']);
    Route::post('/admin/blogcategory/addupdate', [BlogcategoryController::class, 'addupdate']);
    Route::post('/admin/blog_status', [BlogcategoryController::class, 'changeStatus']);
    Route::post('/admin/deleteblog', [BlogcategoryController::class, 'deleteData']);

    // Course page
    Route::get('/admin/coursepage/create', [CoursepageController::class, 'createcoursepage']);
    Route::get('/admin/coursepage/create/{url?}', [CoursepageController::class, 'updatecoursepage']);
    Route::post('/admin/coursepage/addupdate', [CoursepageController::class, 'addupdatecoursepage']);
    Route::get('/admin/coursepage/listing/{d?}', [CoursepageController::class, 'listingcoursepage']);
    Route::post('/admin/coursepage/delete', [CoursepageController::class, 'deleteData']);
    Route::post('/admin/coursepage/coursepage_status', [CoursepageController::class, 'changeStatus']);

    // Course module (child of a course)
    Route::get('/admin/coursemodule/create/{courseid?}', [CoursemoduleController::class, 'createcoursemodule']);
    Route::get('/admin/coursemodule/create/{courseid?}/{url?}', [CoursemoduleController::class, 'updatecoursemodule']);
    Route::post('/admin/coursemodule/addupdate', [CoursemoduleController::class, 'addupdatecoursemodule']);
    Route::get('/admin/coursemodule/listing/{courseid?}', [CoursemoduleController::class, 'listingcoursemodule']);
    Route::post('/admin/coursemodule/delete', [CoursemoduleController::class, 'deleteData']);
    Route::post('/admin/coursemodule/coursepage_status', [CoursemoduleController::class, 'changeStatus']);

    // International program (+ int-content sub-form)
    Route::get('/admin/intprogram/listing/{d?}', [IntprogramController::class, 'listing']);
    Route::get('/admin/intprogram/create', [IntprogramController::class, 'create']);
    Route::get('/admin/intprogram/create/{url?}', [IntprogramController::class, 'edit']);
    Route::post('/admin/intprogram/addupdate', [IntprogramController::class, 'addupdate']);
    Route::post('/admin/intprogram_status', [IntprogramController::class, 'changeStatus']);
    Route::post('/admin/deleteintprogram', [IntprogramController::class, 'deleteData']);
    Route::get('/admin/intcontent/create/{url?}', [IntprogramController::class, 'intcontent']);
    Route::post('/admin/intcontent/addupdate', [IntprogramController::class, 'intcontentaddupdate']);

    // International program page
    Route::get('/admin/intprogrampage/create', [IntprogrampageController::class, 'create']);
    Route::get('/admin/intprogrampage/create/{url?}', [IntprogrampageController::class, 'update']);
    Route::post('/admin/intprogrampage/addupdate', [IntprogrampageController::class, 'addupdate']);
    Route::get('/admin/intprogrampage/listing/{d?}', [IntprogrampageController::class, 'listing']);
    Route::post('/admin/deleteintprogrampage', [IntprogrampageController::class, 'deleteData']);
    Route::post('/admin/intprogrampage/change_status', [IntprogrampageController::class, 'changeStatus']);
});
