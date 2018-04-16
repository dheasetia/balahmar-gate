<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Project;

class ProjectFullyApprovedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $project;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
        $this->user = $project->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('الموافقة على مشروع')
                    ->markdown('emails.email_project_fully_approved');
    }
}
