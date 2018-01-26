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

To enable the default supported data types you need to run fixture
`tecnocen\formgenerator\fixtures\DataTypeFixture` which provides data types

- String data type with cast as string
- Integer data type with cast as integer
- Decimal data type with cast as float
- Boolean data type with cast as boolean
- File data type with cast as yii\web\UploadedFile

You can find the full list of data types on the resource `data-type`.
