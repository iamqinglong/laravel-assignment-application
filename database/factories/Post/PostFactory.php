<?php

namespace Database\Factories\Post;

use Carbon\Carbon;
use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $status = $this->getPostStatus();

        return [
            'title'         => $this->faker->sentence(4, true),
            'slug'          => '',
            'content'       => $this->faker->paragraphs(4, true),
            'status'        => 'published',
            'published_at'  => Carbon::now(),
            'created_at'    => $this->faker->dateTimeBetween('-30 days', 'now'),
            'updated_at'    => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }

    /**
     * Indicate that the user is suspended.
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unpublished()
    {
        return $this->state(function () {
            return [
                'status' => 'draft',
                'published_at' => null,
            ];
        });
    }

    public function published()
    {
        return $this->state(function () {
            return [
                'status' => 'published',
                'published_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
            ];
        });
    }

    public function planned()
    {
        return $this->state(function () {
            return [
                'status' => 'planned',
                'published_at' => $this->faker->dateTimeBetween('tomorrow', '+30 days'),
            ];
        });
    }
}
