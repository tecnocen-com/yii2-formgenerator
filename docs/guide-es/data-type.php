Data Type (Tipo de Dato)
=========

Cada campo tiene un tipo de dato que ayuda a convertir los valores y
organizarlos en como deben ser almacenados internamente en la base de datos.

Cada registro de 'tipo de dato' contiene un name unico y un cast valido

El cast debe de ser el nombre de un metodo estatico de la clase
`tecnocen\formgenerator\models\DataType` o una firma del tipo
`ruta\completa\Clase:metodo` donde `ruta\completa\Clase` es una clase auto
cargable incluyendo namespace y `metodo` es el nombre de un metodo estatico y
publico en la clase anterior.

Ejemplos

- `stringCast`
- `app\models\DataType:json`

Para habilitar los tipos de datos soportados por defectos necesitas correr el
fixture `tecnocen\formgenerator\fixtures\DataTypeFixture` que proporciona Ejemplos
tipos de datos.

- String tipo de dato con cast como string
- Integer tipo de dato con cast como integer
- Decimal tipo de dato con cast como float
- Boolean tipo de dato con cast como boolean
- File tipo de dato con cast como yii\web\UploadedFile

Puedes encontrar la lista completa de tipos de datos en el recurso `data-type`.
