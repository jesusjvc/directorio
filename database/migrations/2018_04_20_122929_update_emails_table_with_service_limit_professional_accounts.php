<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Email_template;

class UpdateEmailsTableWithServiceLimitProfessionalAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $templates = Email_template::where('body', 'like', '%service_limit_professional_providers%')
            ->get();

        if (count($templates) > 0):
            foreach ($templates as $template):
                $newbody = (preg_replace('/service_limit_professional_providers/', 'service_limit_professional_accounts', $template->body));
                $template->update(["body" => $newbody]);
            endforeach;
        endif;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
