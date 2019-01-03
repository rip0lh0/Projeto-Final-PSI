package pt.amsi.ipleiria.pet4all.Models;

public class FileBreed {
    public final static String DB_NAME = "animal";

    private Animal animal;
    private Breed breed;


    public Animal getAnimal() {
        return this.animal;
    }
    public Breed getBreed() {
        return this.breed;
    }

}
