<?php

namespace app\controllers;

use Doctrine\DBAL\Exception;

class CaffeController extends AbstractController
{
    /**
     * @throws Exception
     */
    public function createCheck(): void
    {
        $params = $this->request->getUrl()->getParams();

        if (is_array($body = $this->validateDish($params))) {
            $this->response->json($body, 0);
        }

        $this->db
            ->insert('receipts')
            ->values([
                'dish_id' => '?',
                'open_date' => '?',
            ])
            ->setParameters([
                json_encode([$params['dish_id']]),
                date('Y-m-d H:i:s')
            ])
            ->executeQuery();

        $this->response->json([
            'message' => 'Receipts successfully created!',
            'code' => 200,
        ], 0);
    }

    public function addDish(): void
    {
        $params = $this->request->getUrl()->getParams();

        if (is_array($body = $this->validateDish($params))) {
            $this->response->json($body, 0);
        }

        $dishes = $this->db
            ->select('*')
            ->from('receipts')
            ->where('id = ?')
            ->setParameter(0, $params['receipt_id'])
            ->fetchAssociative();
    }

    public function validateDish(array $params): array|bool
    {
        if (empty($params['dish_id'])) {
            return [
                'message' => 'Error: dish_id not found.',
                'code' => 404,
            ];
        }

        $exists = $this->db
            ->select('*')
            ->from('dishes')
            ->where('id = ?')
            ->setParameter(0, $params['dish_id'])
            ->fetchAssociative();

        if (!$exists) {
            return [
                'message' => "Dish with id {$params['dish_id']} not found.",
                'code' => 404,
            ];
        }

        return true;
    }
}