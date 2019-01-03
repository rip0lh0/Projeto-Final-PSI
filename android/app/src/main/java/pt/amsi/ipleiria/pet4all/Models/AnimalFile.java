package pt.amsi.ipleiria.pet4all.Models;

import java.util.Date;

public class AnimalFile {
    public final static String DB_NAME = "animal";

    private int id;
    private Animal animal;
    private Breed breed;
    private Coat coat;
    private Size size;
    private Energy energy;
    private String chip;
    private int neutered;
    private char gender;
    private Float weight;
    private int age;
    private Date created_at;
    private Date updated_at;


    public int getId() {
        return this.id;
    }
    public Animal getAnimal() {
        return this.animal;
    }
    public Breed getBreed() {
        return this.breed;
    }
    public Coat getCoat() {
        return this.coat;
    }
    public Size getSize() {
        return this.size;
    }
    public Energy getEnergy() {
        return this.energy;
    }
    public String getChip() {
        return this.chip;
    }
    public int getNeutered() {
        return this.neutered;
    }
    public char getGender() {
        return this.gender;
    }
    public Float getWeight() {
        return this.weight;
    }
    public int getAge() {
        return this.age;
    }
    public Date getCreated_at() {
        return this.created_at;
    }
    public Date getUpdated_at() {
        return this.updated_at;
    }
}
