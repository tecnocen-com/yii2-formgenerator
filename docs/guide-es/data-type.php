Data Type (Tipo de Dato)
========================

Cada campo tiene un tipo de dato que ayuda a convertir los valores y
organizarlos en como deben ser almacenados internamente en la base de datos.

Cada registro de 'tipo de dato' contiene un name unico y el nombre completo de
una clase la cual implementa la interfaz
`tecnocen\formgenerator\dataTypes\DataTypeInterface`

Ejemplos

- `tecnocen\formgenerator\dataTypes\BooleanDataType`
- `app\JsonDataType`
- `common\dataTypes\ProtectedFileDataType`

Para habilitar los tipos de datos soportados por defectos necesitas correr el
fixture `tecnocen\formgenerator\fixtures\DataTypeFixture` que proporciona
tipos de datos.

- `string`
- `integer`
- `decimal`
- `boolean`
- `public-file` almacena archivos en la carpeta `@webroot` y muestra la url para
  su lectura.

Puedes encontrar la lista completa de tipos de datos en el recurso de solo
lectura `data-type`.

Traducciones
------------
