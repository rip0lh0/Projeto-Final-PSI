package pt.amsi.ipleiria.pet4all.Models;

import java.util.Date;

public class Treatment {
    public final static String DB_NAME = "animal";

    private int id;
    private AnimalFile animalFile;
    private Breed breed;
    private String description;
    private Date created_at;
    private Date updated_at;


    public int getId() {
        return this.id;
    }
    public AnimalFile getAnimalFile() {
        return this.animalFile;
    }
    public Breed getBreed() {
        return this.breed;
    }
    public String getDescription(){
        return this.description;
    }
    public Date getCreated_at() {
        return this.created_at;
    }
    public Date getUpdated_at() {
        return this.updated_at;
    }

}