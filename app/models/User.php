<?php

namespace App\models;

use App\core\Model;
use Exception;

class User extends Model
{
	public $id;
	public $name;
	public $email;
	public $created_at;
	public $updated_at;

	public function create(array $data)
	{
		$data = to_object($data);
		$sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';
		$user = [
			'name'       => $data->name,
			'email'      => $data->email,
			'password' => $data->password,
		];

		return parent::query($sql, $user);
	}

	/**
	 * @throws Exception
	 */
	public function update()
	{
		$sql = 'UPDATE users SET name=:name, email=:email WHERE id=:id';
		$user = [
			'id'         => $this->id,
			'name'       => $this->name,
			'email'      => $this->email
		];

		try {
			return (bool)parent::query($sql, $user);
		} catch (Exception $exception) {
			throw new Exception($exception);
		}
	}
}