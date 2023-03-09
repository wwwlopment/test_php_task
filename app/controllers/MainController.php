<?php

namespace controllers;

use components\LoggerInterface;
use components\Validator;
use models\User;

/**
 * class MainController
 */
class MainController
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function actionIndex(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $requestData = $_REQUEST;
            $validator = new Validator($requestData);

            $validator->validate([
                'email' => 'required|email',
                'password' => 'required',
                'password_confirm' => 'required|matching_passwords',
            ]);

            if ($validator->passes()) {
                $user = new User();
                $emailExist = $user->getUserByEmail($requestData['email']);
                $logMessage = $emailExist ? 'User with email ' . $requestData['email'] . ' already exist' : 'User with email ' . $requestData['email'] . ' not found';
                $this->logger->log($logMessage);
                if ($emailExist) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'This email already exists. <br> Try another email!'
                    ]);
                    exit();
                }
                $user->addUser($requestData);
                echo json_encode([
                    'success' => true,
                    'message' => 'Congratulations! <br> You have successfully registered'
                ]);
                exit();
            } else {
                $message = '';
                foreach ($validator->errors() as $field => $errors) {

                    $message .= '<div>' . strtoupper($field) . '</div>' . '<p class="error">' . implode('</p><p>', $errors) . '</p>';
                }
                echo json_encode([
                    'success' => false,
                    'message' => $message
                ]);
                exit();
            }
        }
        require_once(ROOT . '/views/index.php');
    }
}
