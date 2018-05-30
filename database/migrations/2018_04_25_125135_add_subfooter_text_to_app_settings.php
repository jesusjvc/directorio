<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\App_setting;

class AddSubfooterTextToAppSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_settings', function($table) {
            $table->text('footer_block')->nullable();
        });

        $footer_block = '<div class="subfooterbox">
    <div class="row">
        <div class="col-sm-3 col-md-offset-1">
            <h1 class="mediacenter">
                Sample Heading Over Here
            </h1>
            <ul class="footerlist mediacenter">
                <li class="col-md-6"><a href="' . url('/sample.html') . '">Sample Content Link</a></li>
                <li class="col-md-6"><a href="' . url('/sample.html') . '">Sample Content Link</a></li>
                <li class="col-md-6"><a href="' . url('/sample.html') . '">Sample Content Link</a></li>
                <li class="col-md-6"><a href="' . url('/sample.html') . '">Sample Content Link</a></li>
            </ul>
        </div>
        <div class="visible-xs">
            <div class="col-xs-12">
                <hr class="white">
            </div>
        </div>
        <div class="col-sm-4">
            <h1 class="mediacenter">
                Sample Heading Over Here
            </h1>
            <ul class="footerlist mediacenter">
                <li class="col-md-6"><a href="' . url('/sample.html') . '">Sample Content Link</a></li>
                <li class="col-md-6"><a href="' . url('/sample.html') . '">Sample Content Link</a></li>
                <li class="col-md-6"><a href="' . url('/sample.html') . '">Sample Content Link</a></li>
                <li class="col-md-6"><a href="' . url('/sample.html') . '">Sample Content Link</a></li>
                <li class="col-md-6"><a href="' . url('/sample.html') . '">Sample Content Link</a></li>
                <li class="col-md-6"><a href="' . url('/sample.html') . '">Sample Content Link</a></li>
            </ul>
        </div>
        <div class="visible-xs">
            <div class="col-xs-12">
                <hr class="white">
            </div>
        </div>
        <div class="col-sm-3">
            <h1 class="mediacenter">
                Sample Heading Over Here
            </h1>
            <ul class="footerlist mediacenter">
                <li class="col-md-6"><a href="' . url('/sample.html') . '">Sample Content Link</a></li>
                <li class="col-md-6"><a href="' . url('/sample.html') . '">Sample Content Link</a></li>
                <li class="col-md-6"><a href="' . url('/sample.html') . '">Sample Content Link</a></li>
                <li class="col-md-6"><a href="' . url('/sample.html') . '">Sample Content Link</a></li>
                <li class="col-md-6"><a href="' . url('/sample.html') . '">Sample Content Link</a></li>
                <li class="col-md-6"><a href="' . url('/sample.html') . '">Sample Content Link</a></li>
            </ul>
        </div>
    </div>
</div>';

        $app_settings = App_setting::first();
        $app_settings->update(["footer_block" => $footer_block]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('app_settings', 'footer_block'))
        {
            Schema::table('app_settings', function($table) {
                $table->dropColumn('footer_block');
            });
        }
    }
}
