<?php
namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Services;
/**
With the help of this command you can create a resource controller in CodeIgniter 4.
1) just create a folder named Commands in app folder 
2) then create a php file with name CreateResourceController.php 
3) and paste the following code.
**/
/**
 * Creates a new migration file.
 *
 * @package CodeIgniter\Commands
 */
class CreateResourceCOntroller extends BaseCommand
{

    /**
     * The group the command is lumped under
     * when listing commands.
     *
     * @var string
     */
    protected $group = 'Controllers';

    /**
     * The Command's name
     *
     * @var string
     */
    protected $name = 'make:controller';

    /**
     * the Command's short description
     *
     * @var string
     */
    protected $description = 'Creates a new Resource Controller file.';

    /**
     * the Command's usage
     *
     * @var string
     */
    protected $usage = 'make:controller [controller_name]';

    /**
     * the Command's Arguments
     *
     * @var array
     */
    protected $arguments = [
        'controller_name' => 'The Resource Controller file name',
    ];

    /**
     * the Command's Options
     *
     * @var array
     */
    protected $options = [
        
    ];

    /**
     * Creates a new migration file with the current timestamp.
     *
     * @param array $params
     */
    public function run(array $params = [])
    {
        helper('inflector');
        $name = array_shift($params);

        if (empty($name)) {
            $name = CLI::prompt(lang('Controller.nameController'));
        }

        if (empty($name)) {
            CLI::error(lang('Controller.badCreateName'));
            return;
        }
        $homepath = APPPATH;
        $ns = 'App';

        // Always use UTC/GMT so global teams can work together
        // $config   = config('Migrations');
        // $fileName = gmdate($config->timestampFormat) . $name;

        // full path
        $path = $homepath . '/Controllers/' . ucfirst($name) . '.php';

        // Class name should be pascal case now (camel case with upper first letter)
        $name = ucfirst($name);

        $template = <<<EOD
<?php 
namespace $ns\Controllers;

class {name} extends BaseController {
    public function __construct()
    {
        //
    }
    public function index()
    {
        echo "Index";
    }
    public function new()
    {
        echo "new";
    }
    public function create()
    {
        echo "create";
    }
    public function edit({id})
    {
        echo "Edit {id}";
    }
    public function show({id})
    {
        echo "Show {id}";
    }
    public function update({id})
    {
    }
    public function delete({id})
    {
        //
    }
}
EOD;
        $template = str_replace('{name}', $name, $template);
         $template = str_replace('{id}', '$id', $template);

        helper('filesystem');
        if (file_exists($path)) {
            CLI::error("File ${path}.php Already Exists");
            return;
        }
        if (! write_file($path, $template)) {
            CLI::error(lang('Controller.writeError', [$path]));
            return;
        }
       
        CLI::write('Created file: ' . CLI::color(str_replace($homepath, $ns, $path), 'green'));
    }
}
