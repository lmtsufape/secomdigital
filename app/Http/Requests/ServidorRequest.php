<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServidorRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
      return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
        'siape' => 'required|numeric',
        'nome' => 'required|string',
        'email' => 'email',
        'data_nascimento' => 'date',
    ];
  }

  public function messages()
  {
    return [
      'required' => 'Este campo é obrigatório',
      'date' => 'A :attribute não é uma data válida.',
      'numeric' => 'O campo :attribute deve ser um número.',
      'email' => 'Email inválido.',

    ];
  }
}
