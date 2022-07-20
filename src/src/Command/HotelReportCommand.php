<?php

namespace App\Command;

use App\Repository\HotelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;

#[AsCommand(
    name: 'app:hotel:report',
    description: 'A command for report of hotels',
)]
class HotelReportCommand extends Command
{
    protected static $defaultName = 'app:hotel:report';
    protected static $defaultDescription = 'A command for report of hotels';

    /** @var HotelRepository */
    private HotelRepository $hotelRepository;

    /** @var EntityManagerInterface */
    private EntityManagerInterface $entityManager;
    private Filesystem $filesystem;

    /**
     * PriceUpdateCommand constructor.
     * @param HotelRepository $hotelRepository
     * @param EntityManagerInterface $entityManager
     * @param string|null $name
     */
    public function __construct(
        HotelRepository $hotelRepository,
        EntityManagerInterface $entityManager,
        Filesystem $filesystem,
        string $name = null
    )
    {
        parent::__construct($name);

        $this->hotelRepository = $hotelRepository;
        $this->entityManager = $entityManager;
        $this->filesystem = $filesystem;
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $result = $this->hotelRepository->createQueryBuilder("h")
            ->select("(h.hotelOwner) as hotelOwner")
            ->addSelect("h.id as id")
            ->addSelect("h.name as name")
            ->addSelect("h.address as address")
            ->getQuery()
            ->getArrayResult();



        $buffered = new BufferedOutput();
        $table = new Table($buffered);
        $table->setHeaders(["Hotel Owner", "ID", "Name", "Address"]);
        $table->setRows($result);
        $table->setStyle("box-double");
        $table->render();

        $this->filesystem->appendToFile("/var/www/html/var/report.txt", $buffered->fetch());

        return 0;
    }
}
