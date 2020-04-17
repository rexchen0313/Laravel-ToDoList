<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

trait ExceptionTrait
{
	public function apiException($exception)
	{
		if ($this->isModelNotFoundException($exception)) {
			$responseMessages = [
				'errors' => '404 Model Not Found'
			];
			$httpStatusCode = Response::HTTP_NOT_FOUND;

			return response()->json($responseMessages, $httpStatusCode);
		}

		if ($this->isNotFoundHttpException($exception)) {
			$responseMessages = [
				'errors' => '404 incorrect route'
			];
			$httpStatusCode = Response::HTTP_NOT_FOUND;

			return response()->json($responseMessages, $httpStatusCode);
		}

		if ($this->isQueryException($exception)) {
			$responseMessages = [
				'errors' => '500 Internal Server Error'
			];
			$httpStatusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
			
			return response()->json($responseMessages, $httpStatusCode);
		}
		if($this->isValidationException($exception))
		{
			$responseMessages = [
				'errors' => $exception->validator->getMessageBag()
			];
			$httpStatusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
			
			return response()->json($responseMessages, $httpStatusCode);
		}
	}

	protected function isModelNotFoundException($exception)
	{
		return $exception instanceof ModelNotFoundException;
	}

	protected function isNotFoundHttpException($exception)
	{
		return $exception instanceof NotFoundHttpException;
	}

	protected function isQueryException($exception)
	{
		return $exception instanceof QueryException;
	}
	protected function isValidationException($exception)
	{
		return $exception instanceof ValidationException;
	}
}
