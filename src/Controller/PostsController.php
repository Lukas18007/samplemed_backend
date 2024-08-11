<?php
namespace App\Controller;
use Cake\View\JsonView;

class PostsController extends AppController
{
    public function viewClasses(): array
    {
        return [JsonView::class];
    }

    public function index()
    {
        $posts = $this->Posts->find('all')->all();
        $this->set('posts', $posts);
        $this->viewBuilder()->setOption('serialize', ['posts']);
    }

    public function view($id)
    {
        $post = $this->Posts->get($id);
        $this->set('post', $post);
        $this->viewBuilder()->setOption('serialize', ['post']);
    }

    public function add()
    {
        $this->request->allowMethod(['post']);
        $post = $this->Posts->newEntity($this->request->getData());

        $message =  $this->Posts->save($post) ?'Saved' : 'Error';

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
        $message = 'Deleted';
        if (!$this->Posts->delete($post)) {
            $message = 'Error';
        }
        $this->set('message', $message);
        $this->viewBuilder()->setOption('serialize', ['message']);
    }
}