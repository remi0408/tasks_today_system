<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Tasks extends BaseController
{
    public function today()
    {
        $taskModel = new TaskModel();

        $data = [
            'tasks' => $taskModel
                ->where('task_date', date('Y-m-d'))
                ->where('is_archived', 0)
                ->orderBy('id', 'ASC')
                ->findAll(),
        ];

        return view('welcome', $data);
    }

    public function index()
    {
        $taskModel = new TaskModel();

        $data = [
            'tasks' => $taskModel
                ->where('is_archived', 0)
                ->orderBy('task_date', 'ASC')
                ->findAll(),
        ];

        return view('tasks', $data);
    }

    public function new()
    {
        helper('form');

        return view('tasks/new');
    }

    public function create()
    {
        $rules = [
            'title' => [
                'label' => 'Title',
                'rules' => 'required|max_length[150]',
            ],
            'task_date' => [
                'label' => 'Task Date',
                'rules' => 'required|valid_date[Y-m-d]',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        (new TaskModel())->insert([
            'title'       => trim((string) $this->request->getPost('title')),
            'status'      => 'pending',
            'is_archived' => 0,
            'task_date'   => $this->request->getPost('task_date'),
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()
            ->to('/tasks')
            ->with('success', 'Task created successfully.');
    }

    public function edit($id)
    {
        helper('form');

        $task = (new TaskModel())->find($id);

        if (! $task) {
            throw PageNotFoundException::forPageNotFound('Task not found.');
        }

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    public function update($id)
    {
        $taskModel = new TaskModel();
        $task = $taskModel->find($id);

        if (! $task) {
            throw PageNotFoundException::forPageNotFound('Task not found.');
        }

        $rules = [
            'title' => [
                'label' => 'Title',
                'rules' => 'required|max_length[150]',
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required|in_list[pending,completed]',
            ],
            'task_date' => [
                'label' => 'Task Date',
                'rules' => 'required|valid_date[Y-m-d]',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $taskModel->update($id, [
            'title'     => trim((string) $this->request->getPost('title')),
            'status'    => $this->request->getPost('status'),
            'task_date' => $this->request->getPost('task_date'),
        ]);

        return redirect()
            ->to('/tasks')
            ->with('success', 'Task updated successfully.');
    }

    public function archive($id)
    {
        $taskModel = new TaskModel();
        $task = $taskModel->find($id);

        if (! $task) {
            throw PageNotFoundException::forPageNotFound('Task not found.');
        }

        $taskModel->update($id, [
            'is_archived' => 1,
        ]);

        return redirect()
            ->to('/tasks')
            ->with('success', 'Task archived successfully.');
    }
}