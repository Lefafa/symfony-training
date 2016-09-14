<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JobSkill
 *
 * @ORM\Table(name="job_skill")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JobSkillRepository")
 */
class JobSkill
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="level", type="string", length=255)
     */
    private $level;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Job")
     * @ORM\JoinColumn(nullable=false)
     */
    private $job;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Skill")
     * @ORM\JoinColumn(nullable=false)
     */
    private $skill;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set level
     *
     * @param string $level
     * @return JobSkill
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return string 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set job
     *
     * @param \AppBundle\Entity\Job $job
     * @return JobSkill
     */
    public function setJob(\AppBundle\Entity\Job $job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return \AppBundle\Entity\Job 
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set skill
     *
     * @param \AppBundle\Entity\Skill $skill
     * @return JobSkill
     */
    public function setSkill(\AppBundle\Entity\Skill $skill)
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get skill
     *
     * @return \AppBundle\Entity\Skill 
     */
    public function getSkill()
    {
        return $this->skill;
    }
}
