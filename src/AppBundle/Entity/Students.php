<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Student
 *
 * @ORM\Table(name="students")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StudentsRepository")
 */
class Students
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="father_name", type="string", length=255)
     */
    private $fatherName;

    /**
     * @var int
     *
     * @ORM\Column(name="phone_number", type="integer", nullable=true)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text", nullable=true)
     */
    private $address;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="admission_date", type="date")
     */
    private $admissionDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="leaving_date", type="date")
     */
    private $leavingDate;

    /**
     * @var int
     *
     * @ORM\Column(name="class_id", type="integer")
     */
    private $classId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="current_class_joining_date", type="date", nullable=true)
     */
    private $currentClassJoiningDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ctreated_at", type="datetime")
     */
    private $ctreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Student
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set fatherName
     *
     * @param string $fatherName
     *
     * @return Student
     */
    public function setFatherName($fatherName)
    {
        $this->fatherName = $fatherName;

        return $this;
    }

    /**
     * Get fatherName
     *
     * @return string
     */
    public function getFatherName()
    {
        return $this->fatherName;
    }

    /**
     * Set phoneNumber
     *
     * @param integer $phoneNumber
     *
     * @return Student
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return int
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Student
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set admissionDate
     *
     * @param \DateTime $admissionDate
     *
     * @return Student
     */
    public function setAdmissionDate($admissionDate)
    {
        $this->admissionDate = $admissionDate;

        return $this;
    }

    /**
     * Get admissionDate
     *
     * @return \DateTime
     */
    public function getAdmissionDate()
    {
        return $this->admissionDate;
    }

    /**
     * Set leavingDate
     *
     * @param \DateTime $leavingDate
     *
     * @return Student
     */
    public function setLeavingDate($leavingDate)
    {
        $this->leavingDate = $leavingDate;

        return $this;
    }

    /**
     * Get leavingDate
     *
     * @return \DateTime
     */
    public function getLeavingDate()
    {
        return $this->leavingDate;
    }

    /**
     * Set classId
     *
     * @param integer $classId
     *
     * @return Student
     */
    public function setClassId($classId)
    {
        $this->classId = $classId;

        return $this;
    }

    /**
     * Get classId
     *
     * @return int
     */
    public function getClassId()
    {
        return $this->classId;
    }

    /**
     * Set currentClassJoiningDate
     *
     * @param \DateTime $currentClassJoiningDate
     *
     * @return Student
     */
    public function setCurrentClassJoiningDate($currentClassJoiningDate)
    {
        $this->currentClassJoiningDate = $currentClassJoiningDate;

        return $this;
    }

    /**
     * Get currentClassJoiningDate
     *
     * @return \DateTime
     */
    public function getCurrentClassJoiningDate()
    {
        return $this->currentClassJoiningDate;
    }

    /**
     * Set ctreatedAt
     *
     * @param \DateTime $ctreatedAt
     *
     * @return Student
     */
    public function setCtreatedAt($ctreatedAt)
    {
        $this->ctreatedAt = $ctreatedAt;

        return $this;
    }

    /**
     * Get ctreatedAt
     *
     * @return \DateTime
     */
    public function getCtreatedAt()
    {
        return $this->ctreatedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Student
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}

