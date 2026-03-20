<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Models\InterestModel;
use Models\ProgrammeModel;

final class StudentController extends Controller
{
    private ProgrammeModel $programmes;
    private InterestModel $interests;

    public function __construct()
    {
        $this->programmes = new ProgrammeModel();
        $this->interests = new InterestModel();
    }

    public function landing(): void
    {
        $this->view('student/landing', [
            'programmeCount' => count($this->programmes->allPublished(null, '')),
        ]);
    }

    public function index(): void
    {
        $level = isset($_GET['level']) && ctype_digit((string) $_GET['level']) ? (int) $_GET['level'] : null;
        $query = trim((string) ($_GET['q'] ?? ''));

        $this->view('student/index', [
            'programmes' => $this->programmes->allPublished($level, $query),
            'levels' => $this->programmes->levels(),
            'selectedLevel' => $level,
            'query' => $query,
        ]);
    }

    public function show(int $id): void
    {
        $programme = $this->programmes->find($id);
        if (!$programme) {
            http_response_code(404);
            echo 'Programme not found.';
            return;
        }

        $this->view('student/show', [
            'programme' => $programme,
            'modulesByYear' => $this->programmes->modulesByYear($id),
        ]);
    }

    public function registerInterest(): void
    {
        verify_csrf();
        $programmeId = (int) ($_POST['programme_id'] ?? 0);
        $name = trim(strip_tags((string) ($_POST['student_name'] ?? '')));
        $email = trim((string) ($_POST['email'] ?? ''));

        if ($programmeId < 1 || $name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            flash('error', 'Please provide valid details.');
            redirect('/programme/' . $programmeId);
        }

        if ($this->interests->register($programmeId, $name, $email)) {
            flash('success', 'Interest registered successfully.');
        } else {
            flash('error', 'Could not register interest (possibly duplicate email for this programme).');
        }

        redirect('/programme/' . $programmeId);
    }

    public function withdrawInterest(): void
    {
        verify_csrf();
        $programmeId = (int) ($_POST['programme_id'] ?? 0);
        $email = trim((string) ($_POST['email'] ?? ''));

        if ($programmeId < 1 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            flash('error', 'Please provide a valid email.');
            redirect('/programme/' . $programmeId);
        }

        if ($this->interests->withdraw($programmeId, $email)) {
            flash('success', 'Interest withdrawn successfully.');
        } else {
            flash('error', 'No matching interest found for this email and programme.');
        }

        redirect('/programme/' . $programmeId);
    }
}
