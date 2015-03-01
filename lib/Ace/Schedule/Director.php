<?php namespace Ace\Schedule;

/**
 * Directs building a set of MatcherInterfaces from a formatted schedule string
 * Integrates ParserInterface with BuilderInterface to create an Entry
 */
class Director implements DirectorInterface
{
    /**
     * @var BuilderInterface
     */
    private $builder;

    /**
     * @var ParserInterface
     */
    private $parser;

    /**
     * @param BuilderInterface $builder
     */
    public function setBuilder(BuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param ParserInterface $parser
     */
    public function setParser(ParserInterface $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param string $schedule
     */
    public function create($schedule)
    {
        if (!$this->builder) {
            throw new Exception('BuilderInterface instance not set');
        }

        if (!$this->parser) {
            throw new Exception('Parser instance not set');
        }

        $this->parser->parse($schedule);

        // call a builder method for each item
        $this->builder->buildMinute($this->parser->getMinute());
        $this->builder->buildHour($this->parser->getHour());
        $this->builder->buildDay($this->parser->getDay());
        $this->builder->buildMonth($this->parser->getMonth());
        if ($this->parser->getWeekDay()) {
            $this->builder->buildWeekDay($this->parser->getWeekDay());
        }
        // build a year too
    }
}
