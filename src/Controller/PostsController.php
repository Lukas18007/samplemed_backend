<?php
namespace App\Controller;

use Cake\View\JsonView;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Exception\InternalErrorException;

class PostsController extends AppController
{
    public function viewClasses(): array
    {
        return [JsonView::class];
    }

    public function index()
    {
        $posts = $this->Posts->find('all')->all();
        if (!$posts) {
            throw new NotFoundException(__('Posts not found'));
        }
        $this->set('posts', $posts);
        $this->viewBuilder()->setOption('serialize', ['posts']);
    }

    public function view($id)
    {
        $post = $this->Posts->get($id);
        if (!$post) {
            throw new NotFoundException(__('Post not found'));
        }
        $this->set('post', $post);
        $this->viewBuilder()->setOption('serialize', ['post']);
    }

    public function add()
    {
        $this->request->allowMethod(['post']);
        $post = $this->Posts->newEntity($this->request->getData());

        if (!$post->getErrors() && $this->Posts->save($post)) {
            $message = 'Saved';
        } else {
            throw new BadRequestException(__('Unable to save post'));
        }

        $this->set([
            'message' => $message,
            'post' => $post,
        ]);
        $this->viewBuilder()->setOption('serialize', ['post', 'message']);
    }

    public function delete($id)
    {
        $this->request->allowMethod(['delete']);

        $post = $this->Posts->get($id);
        if (!$post) {
            throw new NotFoundException(__('Post not found'));
        }

        if (!$this->Posts->delete($post)) {
            throw new InternalErrorException(__('Unable to delete post'));
        }

        $this->set('message', 'Deleted');
        $this->viewBuilder()->setOption('serialize', ['message']);
    }
}
