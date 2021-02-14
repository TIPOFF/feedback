<?php 

declare(strict_types=1);

namespace Tipoff\Feedback\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Feedback\Models\Feedback;

class FeedbackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feedback::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $actiondate = $this->faker->dateTimeBetween('-1 months', 'now');
        if ($this->faker->boolean) {
            $messagetext = $this->faker->sentences(5, true);
            $submitted = $actiondate;
        } else {
            $messagetext = null;
            $submitted = null;
        }

        if ($this->faker->boolean) {
            // Opened Email
            $opened_at = $actiondate;
            $clicked_negative_at = null;
            $clicked_semi_negative_at = null;
            $clicked_positive_at = null;
            $clicked_semi_positive_at = null;
            $clicked_review_at = null;
            $redirected_at = null;
            $message = null;
            if ($this->faker->boolean) {
                // Positive
                if ($this->faker->boolean) {
                    // Positive
                    $opened_at = $actiondate;
                    $clicked_negative_at = null;
                    $clicked_semi_negative_at = null;
                    $clicked_positive_at = $actiondate;
                    $clicked_semi_positive_at = null;
                    $clicked_review_at = $actiondate;
                    $redirected_at = $actiondate;
                    $message = null;
                    $submitted_at = null;
                } else {
                    // Semi Positive
                    $opened_at = $actiondate;
                    $clicked_negative_at = null;
                    $clicked_semi_negative_at = null;
                    $clicked_positive_at = null;
                    $clicked_semi_positive_at = $actiondate;
                    $clicked_review_at = null;
                    $redirected_at = null;
                    $message = $messagetext;
                    $submitted_at = $submitted;
                }
            } else {
                // Negative
                if ($this->faker->boolean) {
                    // Negative
                    $opened_at = $actiondate;
                    $clicked_negative_at = $actiondate;
                    $clicked_semi_negative_at = null;
                    $clicked_positive_at = null;
                    $clicked_semi_positive_at = null;
                    $clicked_review_at = null;
                    $redirected_at = null;
                    $message = $messagetext;
                    $submitted_at = $submitted;
                } else {
                    // Semi Negative
                    $opened_at = $actiondate;
                    $clicked_negative_at = null;
                    $clicked_semi_negative_at = $actiondate;
                    $clicked_positive_at = null;
                    $clicked_semi_positive_at = null;
                    $clicked_review_at = null;
                    $redirected_at = null;
                    $message = $messagetext;
                    $submitted_at = $submitted;
                }
            }
        } else {
            // Not responded
            $opened_at = null;
            $clicked_negative_at = null;
            $clicked_semi_negative_at = null;
            $clicked_positive_at = null;
            $clicked_semi_positive_at = null;
            $clicked_review_at = null;
            $redirected_at = null;
            $message = null;
            $submitted_at = null;
        }

        return [
            'participant_id'            => randomOrCreate(app('participant')),
            'location_id'               => randomOrCreate(app('location')),
            'date'                      => $this->faker->date(), // Should be a day less than emailed_at
            'emailed_at'                => $this->faker->dateTimeBetween('-3 months', '-1 months'),
            'email_identifier'          => Str::random(100),
            'opened_at'                 => $opened_at,
            'clicked_negative_at'       => $clicked_negative_at,
            'clicked_semi_negative_at'  => $clicked_semi_negative_at,
            'clicked_semi_positive_at'  => $clicked_semi_positive_at,
            'clicked_positive_at'       => $clicked_positive_at,
            'clicked_review_at'         => $clicked_review_at,
            'redirected_at'             => $redirected_at,
            'message'                   => $message,
            'submitted_at'              => $submitted_at,
        ];
    }
}
