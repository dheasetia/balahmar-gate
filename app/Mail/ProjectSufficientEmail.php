<?php

namespace App\Mail;

use App\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class ProjectSufficientEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $project;
    public $user;
    public $other_project;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
        $this->other_project = Project::find($project->other_project_donated_id);
        $this->user = $project->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('الاكتفاء بالدعم على المشاريع السابقة')
            ->markdown('emails.email_project_sufficient');
    }
}
