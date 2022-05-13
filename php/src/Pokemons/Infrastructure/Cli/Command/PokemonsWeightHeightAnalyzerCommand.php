<?php

namespace App\Pokemons\Infrastructure\Cli\Command;

use App\Pokemons\Application\RetrieveAll\PokemonsAveragesRetriever;
use App\Pokemons\Domain\PokemonsAverages;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PokemonsWeightHeightAnalyzerCommand extends Command
{
    public const NAME = 'app:pokemons-analyzer';

    private PokemonsAveragesRetriever $pokemonsAveragesRetriever;

    public function __construct(PokemonsAveragesRetriever $pokemonsAveragesRetriever)
    {
        parent::__construct(self::NAME);
        $this->pokemonsAveragesRetriever = $pokemonsAveragesRetriever;
    }

    protected function configure()
    {
        parent::configure();
        $this
            ->addOption('offset', 'o', InputOption::VALUE_OPTIONAL, 'Where to start', 0)
            ->addOption('limit', 'l', InputOption::VALUE_OPTIONAL, 'How many', 20);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $start = microtime(true);

        $averagesResponse = $this->pokemonsAveragesRetriever->getAverages(
            $input->getOption('offset'),
            $input->getOption('limit')
        );

        $averages = PokemonsAverages::fromPrimitives($averagesResponse->weight(), $averagesResponse->height());

        $duration = microtime(true) - $start;
        $miliseconds = $duration * 1000;
        $table = new Table($output);
        $table->setHeaders(['Weight', 'Height', 'Time (ms)']);
        $table->addRow([
            number_format($averages->weight(), 2),
            number_format($averages->height(), 2),
            $miliseconds,
        ]);

        $table->render();

        return Command::SUCCESS;
    }
}
