<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbacksTable extends Migration
{
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('token')->index()->unique(); // unique hash for the feedback so can use in links instead of the id
            $table->foreignIdFor(app('participant'))->index();
            $table->foreignIdFor(app('location'))->index();
            $table->date('date')->index(); // date the escape room game was played
            $table->dateTime('emailed_at')->nullable();
            $table->string('email_identifier')->nullable()->unique(); // "MessageID" from Postmark or email service needed to track opens since multiple feedbacks could exist and can't track opens to the participant
            $table->dateTime('opened_at')->nullable();
            $table->dateTime('clicked_negative_at')->nullable();
            $table->dateTime('clicked_semi_negative_at')->nullable();
            $table->dateTime('clicked_semi_positive_at')->nullable();
            $table->dateTime('clicked_positive_at')->nullable();
            $table->dateTime('clicked_review_at')->nullable();
            $table->dateTime('redirected_at')->nullable();
            $table->text('message')->nullable();
            $table->dateTime('submitted_at')->nullable(); // message submitted datetime
            $table->softDeletes(); // Soft delete if email bounces. Also need to soft delete the Participant & update the waiver signature.
            $table->timestamps();
        });
    }
}
