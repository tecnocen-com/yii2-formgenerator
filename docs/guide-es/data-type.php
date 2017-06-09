Data Type
=========

Each field has a data type which helps casting values and organize them
depending on how they are stored internally on the database.

Each record of data type contain a unique `name` and a valid `cast`.

The cast must be the name of an static method on the class
`tecnocen\formgenerator\models\DataType` or a signature of the type
`full\class\Name:method` where `full\class\Name` is a namespaced autoloadable
class and `method` is the name of an static method on the previous class.

Examples

- `stringCast`
- `app\models\DataType:json`

By default he following casts are supported.

- string
- integer
- float
- boolean
- uploaded-file

You can find the full list of data types on the resource `data-type`.
