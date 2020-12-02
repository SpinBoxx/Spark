<?php

namespace App\Command;

use App\Entity\Brand;
use App\Entity\Color;
use App\Entity\Gender;
use App\Entity\Size;
use App\Entity\Type;
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
        $sizes = ["XS","S","M","L","XL"];
        $genders = ["Homme", "Femme", "NA", "Enfant"];
        $color_repo = $this->em->getRepository(Color::class);
        $brand_repo = $this->em->getRepository(Brand::class);
        $size_repo = $this->em->getRepository(Size::class);
        $gender_repo = $this->em->getRepository(Gender::class);
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

            //remove all existing brand

            foreach ($brand_repo->findAll() as $brand) {
                $this->em->remove($brand);
            }

            $io->note("Brand table data removed");
            foreach ($brands as $brand) {
                $this->em->persist(new Brand($slugify->slugify($brand), $brand));
                $io->note($brand . " Created");
            }

            //remove all existing size

//            foreach ($size_repo->findAll() as $size) {
//                $this->em->remove($size);
//            }
//
//            $io->note("Size table data removed");
//            foreach ($sizes as $size) {
//                $this->em->persist(new Size(new Type(), $slugify->slugify($size), $size));
//                $io->note($size . " Created");
//            }

            //remove all existing gender

            foreach ($gender_repo->findAll() as $gender) {
                $this->em->remove($gender);
            }

            $io->note("Gender table data removed");
            foreach ($genders as $gender) {
                $this->em->persist(new Gender($slugify->slugify($gender), $gender));
                $io->note($gender . " Created");
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
            foreach ($brands as $brand) {
                // Check if NOT exist
                if ($brand_repo->findBy(["label" => $brand]) == null) {
                    $this->em->persist(new Brand($slugify->slugify($brand), $brand));
                    $io->note($brand);
                }
                $io->note($brand . " already exist");
            }
//            foreach ($sizes as $size) {
//                // Check if NOT exist
//                if ($brand_repo->findBy(["label" => $size]) == null) {
//                    $this->em->persist(new Size(new Type(), $slugify->slugify($size), $size));
//                    $io->note($size);
//                }
//                $io->note($brand . " already exist");
//            }
            foreach ($genders as $gender) {
                // Check if NOT exist
                if ($gender_repo->findBy(["label" => $gender]) == null) {
                    $this->em->persist(new Gender($slugify->slugify($gender), $gender));
                    $io->note($gender);
                }
                $io->note($gender . " already exist");
            }
        }
        $this->em->flush();
        $io->success('Succesfully populate database');

        return Command::SUCCESS;
    }
}
