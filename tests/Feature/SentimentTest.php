<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\Sentimentality;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SentimentalityTest extends TestCase
{
    /** @test */
    public function sentence_has_scores()
    {
        $sentence = 'This is a very good sentence';
        $sentimentality = new Sentimentality();
        $scores = $sentimentality->scores($sentence);

        $this->assertEquals(0.3, $scores['negative']);
        $this->assertEquals(0.3, $scores['neutral']);
        $this->assertEquals(0.4, $scores['positive']);
    }

    /** @test */
    public function sentence_has_decision()
    {
        $sentence = 'This is a very good sentence';
        $sentimentality = new Sentimentality();
        $decision = $sentimentality->decision($sentence);
        $this->assertEquals('positive', $decision);
    }

    /** @test */
    public function sentence_has_score()
    {
        $sentence = 'This is a very good sentence';
        $sentimentality = new Sentimentality();
        $score = $sentimentality->score($sentence);
        $this->assertEquals(0.4, $score);
    }
}
