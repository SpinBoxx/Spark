<?php

namespace App\Command;

use App\Entity\Category;
use App\Entity\Color;
use App\Entity\Product;
use App\Entity\State;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Cocur\Slugify\Slugify;

class PopulateDatabaseCommand extends Command
{
    protected static $defaultName = 'app:populate-database';

    /** @var EntityManagerInterface $em * */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add necessary data in several tables')
            ->addOption(
                'recreate',
                '-r',
                InputOption::VALUE_NONE,
                'Recreate tables'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $slugify = new Slugify();
        $color_array = [
            "red" => "#FF0000",
            "blue" => "#0000FF",
            "yellow" => "#FFFF00",
            "black" => "#000000",
            "white" => "#FFFFFF",
            "orange" => "#FF6600",
            "green" => "#00FF00",
            "purple" => "#6600FF",
        ];
        $brands = [
            "Adidas",
            "Nike",
            "Puma",
            "Reebok",
            "Kappa",
            "New Balance"
        ];
        $sizes = ["XS", "S", "M", "L", "XL"];
        $genders = ["Homme", "Femme", "NA", "Enfant"];
        $color_repo = $this->em->getRepository(Color::class);
        $product_repo = $this->em->getRepository(Product::class);
        $user_repo = $this->em->getRepository(User::class);

        $connection = $this->em->getConnection();
        $io = new SymfonyStyle($input, $output);

        // if recreate option specified

        if ($input->getOption('recreate')) {

            //remove all existing color

            foreach ($color_repo->findAll() as $color) {
                $this->em->remove($color);
            }

            $io->note("Color table data removed");
            foreach ($color_array as $color => $hex) {
                $this->em->persist(new Color($slugify->slugify($color), $color, $hex));
                $io->note($color . " " . $hex . " Created");
            }

        } else {
            foreach ($color_array as $color => $hex) {
                // Check if NOT exist
                if ($color_repo->findBy(["label" => $color]) == null) {
                    $this->em->persist(new Color($slugify->slugify($color), $color, $hex));
                    $io->note($color . " " . $hex);
                }
                $io->note($color . " " . $hex . " already exist");
            }
            //Add a User
            $this->em->persist(new User('username',
                'jean',
                'dupont',
                'jean.dupont@email.com',
                base64_encode('password'),
                'ROLE_USER',
                new \DateTime('now'),
            1
            ));
            // Add a product
            $user = $user_repo->findOneBy(['username' => 'alexis']);

            $this->em->persist(new Product($user,
                new State('Vendu', 'Vendu'),
                'title',
                'description',
                [],
                'Male',
                'XS',
                new Color('Red', 'Red', '#FFFFFF'),
                new Color('Red', 'Red', '#FFFFFF'),
                'Adidas',
                'Neuf',
                new Category('Tennis', 'Tennis'),
                1.25
            ));
            $io->note("Product creatd");


        }
        $this->em->flush();
        $io->success('Succesfully populate database');

        return Command::SUCCESS;
    }
}
