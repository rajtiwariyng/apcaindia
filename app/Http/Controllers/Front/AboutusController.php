<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Public: the "About us" cluster of static-ish pages. Ported from the legacy
 * Aboutus\AboutusController.
 *
 * Every page shared the same banner + placement-partners lookup; that is now in
 * base(). Per-method extras and the (inconsistent) page-view logging are kept
 * exactly as the legacy code had them — note `news`, `news-details` and
 * `terms-and-conditions` did NOT log a page view.
 */
class AboutusController extends Controller
{
    /**
     * Common data every About page loaded (current-page banner + partners).
     *
     * @return array<string, mixed>
     */
    private function base(Request $request): array
    {
        $page = $request->segment(count($request->segments()));

        return [
            'banner' => DB::table('banner_videos')->where('page', $page)->where('status', 1)->orderBy('id', 'asc')->first(),
            'placementpartners' => DB::table('tbl_placementpartners')->orderBy('id', 'desc')->where('status', '=', 1)->get(),
        ];
    }

    public function achivements(Request $request)
    {
        $data = $this->base($request);
        record_page_view($request);

        return view('Aboutus::achivements', compact('data'));
    }

    public function achivementsGallery(Request $request)
    {
        $data = $this->base($request);
        record_page_view($request);

        return view('Aboutus::achivements-gallery', compact('data'));
    }

    public function explore(Request $request)
    {
        $data = $this->base($request);
        $data['supportingbrands'] = DB::table('tbl_supportingbrands')->orderBy('id', 'desc')->where('status', '=', 1)->get();
        $data['apcaMalaysia'] = DB::table('tbl_pages')->orderBy('id', 'desc')->where('status', '=', 1)->where('uniqueid', '=', '68470033c17c5')->first();
        $data['apcaMalaysia2'] = DB::table('tbl_pages')->orderBy('id', 'desc')->where('status', '=', 1)->where('uniqueid', '=', '684701755f239')->first();
        $data['apcaMalaysia3'] = DB::table('tbl_pages')->orderBy('id', 'desc')->where('status', '=', 1)->where('uniqueid', '=', '6847021aece57')->first();
        $data['apcaMalaysia4'] = DB::table('tbl_pages')->orderBy('id', 'desc')->where('status', '=', 1)->where('uniqueid', '=', '6847028be85e2')->first();
        record_page_view($request);

        return view('Aboutus::explore', compact('data'));
    }

    public function faculty(Request $request)
    {
        $data = $this->base($request);
        record_page_view($request);

        return view('Aboutus::faculty', compact('data'));
    }

    public function academy(Request $request)
    {
        $data = $this->base($request);
        $data['FTPrograms'] = DB::table('tbl_pdf')->orderBy('id', 'asc')->where('status', '=', 1)->where('page', '=', 'Full Time Programs Flyer')->get();
        $data['STPrograms'] = DB::table('tbl_pdf')->orderBy('id', 'asc')->where('status', '=', 1)->where('page', '=', 'Short Intensive Programs Flyer')->get();
        $data['wProgramsf'] = DB::table('tbl_pdf')->orderBy('id', 'asc')->where('status', '=', 1)->where('page', '=', 'Part-Time Weekend Programs Flyer')->first();
        $data['wPrograms'] = DB::table('tbl_pdf')->orderBy('id', 'asc')->where('status', '=', 1)->where('page', '=', 'Part-Time Weekend Programs Form')->first();
        $data['intakecalendar'] = DB::table('tbl_pdf')->where('page', '=', 'intakecalender')->first();
        record_page_view($request);

        return view('Aboutus::academy-resource', compact('data'));
    }

    public function internationalPaidInternship(Request $request)
    {
        $data = $this->base($request);
        $data['intprograms'] = DB::table('tbl_intprogram')->orderBy('order_by', 'asc')->where('status', '=', 1)->get();
        $data['intcontent'] = DB::table('tbl_intcontent')->first();
        record_page_view($request);

        return view('Aboutus::international-paid-internship', compact('data'));
    }

    public function faq(Request $request)
    {
        $data = $this->base($request);
        $data['faqs'] = DB::table('tbl_faqs')->orderBy('id', 'asc')->where('status', '=', 1)->get();
        record_page_view($request);

        return view('Aboutus::faq', compact('data'));
    }

    public function accomodation(Request $request)
    {
        $data = $this->base($request);
        record_page_view($request);

        return view('Aboutus::accomodation', compact('data'));
    }

    public function onlineRegistration(Request $request)
    {
        $data = $this->base($request);
        record_page_view($request);

        return view('Aboutus::online-registration', compact('data'));
    }

    public function paynow(Request $request)
    {
        $data = $this->base($request);
        record_page_view($request);

        return view('Aboutus::pay-now', compact('data'));
    }

    public function privacypolicy(Request $request)
    {
        $data = $this->base($request);
        record_page_view($request);

        return view('Aboutus::privacy-policy', compact('data'));
    }

    public function termsandconditions(Request $request)
    {
        // Legacy did NOT log a page view here (the insert was dead code after return).
        $data['placementpartners'] = DB::table('tbl_placementpartners')->orderBy('id', 'desc')->where('status', '=', 1)->get();

        return view('Aboutus::terms-and-conditions', compact('data'));
    }

    public function gallery(Request $request)
    {
        $data = $this->base($request);
        $data['gallery'] = DB::table('tbl_gallery')->where('status', '=', 1)->get();
        record_page_view($request);

        return view('Aboutus::gallery', compact('data'));
    }

    public function news(Request $request)
    {
        // Legacy did NOT log a page view here.
        $data = $this->base($request);

        return view('Aboutus::news', compact('data'));
    }

    public function newsDetails(Request $request)
    {
        // Legacy did NOT log a page view here.
        $data = $this->base($request);

        return view('Aboutus::news-details', compact('data'));
    }

    public function AwardsAccolades(Request $request)
    {
        $data = $this->base($request);
        $data['awards'] = DB::table('tbl_pages')->orderBy('id', 'desc')->where('status', '=', 1)->where('pages', '=', 'Awards & Accolades')->first();
        record_page_view($request);

        return view('Aboutus::awards-accolades', compact('data'));
    }

    public function messageFromFounder(Request $request)
    {
        $data = $this->base($request);
        $data['foundermsg'] = DB::table('tbl_pages')->orderBy('id', 'desc')->where('status', '=', 1)->where('pages', '=', 'Message from director')->first();
        record_page_view($request);

        return view('Aboutus::message-from-founder', compact('data'));
    }

    public function admission(Request $request)
    {
        $data = $this->base($request);
        record_page_view($request);

        return view('Aboutus::admission', compact('data'));
    }

    public function careerOpportunities(Request $request)
    {
        $data = $this->base($request);
        record_page_view($request);

        return view('Aboutus::career-opportunities', compact('data'));
    }

    public function career(Request $request)
    {
        $data = $this->base($request);
        record_page_view($request);

        return view('Aboutus::career', compact('data'));
    }

    public function recipeAndInspiration(Request $request)
    {
        $data = $this->base($request);
        record_page_view($request);

        return view('Aboutus::recipe-and-inspiration', compact('data'));
    }

    public function industrialVisit(Request $request)
    {
        $data = $this->base($request);
        record_page_view($request);

        return view('Aboutus::industrial-visit', compact('data'));
    }

    public function recipesAndInspiration(Request $request)
    {
        $data = $this->base($request);
        record_page_view($request);

        return view('Aboutus::recipes-and-inspiration', compact('data'));
    }

    public function chefEducator(Request $request)
    {
        $data = $this->base($request);
        $data['chefeducators'] = DB::table('tbl_chefeducators')->orderBy('id', 'asc')->where('status', '=', 1)->get();
        record_page_view($request);

        return view('Aboutus::chef-educator', compact('data'));
    }

    public function apcaAlumni(Request $request)
    {
        $data = $this->base($request);
        $data['alumnies'] = DB::table('tbl_alumni')->orderBy('id', 'asc')->where('status', '=', 1)->get();
        record_page_view($request);

        return view('Aboutus::apca-alumni', compact('data'));
    }

    public function apcaPrograms(Request $request)
    {
        $data = $this->base($request);
        record_page_view($request);

        return view('Aboutus::apca-programs', compact('data'));
    }

    public function programFlyers(Request $request)
    {
        $data = $this->base($request);
        record_page_view($request);

        return view('Aboutus::program-flyers', compact('data'));
    }

    public function academicIntakeCalendar(Request $request)
    {
        $data = $this->base($request);
        record_page_view($request);

        return view('Aboutus::academic-intake-calendar', compact('data'));
    }

    public function programApplication(Request $request)
    {
        $data = $this->base($request);
        record_page_view($request);

        return view('Aboutus::program-application', compact('data'));
    }

    public function visitTheAcademy(Request $request)
    {
        $data = $this->base($request);
        record_page_view($request);

        return view('Aboutus::visit-the-academy', compact('data'));
    }

    public function bangalore(Request $request)
    {
        $data = $this->cityData($request);

        return view('Aboutus::bangalore', compact('data'));
    }

    public function gurgaon(Request $request)
    {
        $data = $this->cityData($request);

        return view('Aboutus::gurgaon', compact('data'));
    }

    public function mumbai(Request $request)
    {
        $data = $this->cityData($request);

        return view('Aboutus::mumbai', compact('data'));
    }

    public function delhi(Request $request)
    {
        $data = $this->cityData($request);

        return view('Aboutus::delhi', compact('data'));
    }

    /**
     * The four city pages shared the same data set + page-view logging.
     *
     * @return array<string, mixed>
     */
    private function cityData(Request $request): array
    {
        $data = $this->base($request);
        $data['foundermsg'] = DB::table('tbl_pages')->orderBy('id', 'desc')->where('status', '=', 1)->where('pages', '=', 'Message from director')->first();
        $data['faqs'] = DB::table('tbl_faqs')->orderBy('id', 'asc')->where('status', '=', 1)->where('home', '=', 1)->get();
        record_page_view($request);

        return $data;
    }
}
