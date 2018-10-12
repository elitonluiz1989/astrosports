<?php

namespace App\Handlers;

trait ValidatorExceptionHandler {

    private function handleValidatorException($exception) {
        if ($exception->validator) {
            $data = [];
            foreach ($exception->validator->customMessages as $message) {
                if (\is_array($message)) {
                    foreach ($message as $msg) {
                        \array_push($data, $msg);
                    }
                } else {
                    \array_push($data, $message);
                }
            }
        } else {
            $data = $exception->getMessage();
        }

        return $data;
    }
}