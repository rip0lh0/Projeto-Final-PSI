package pt.amsi.ipleiria.pet4all.Models;

public class Breed {
    public final static String DB_NAME = "animal";

    private int id;
    private Breed breed;
    private String name;
    private String description;
    private String origin;
    private String lifespan;


    public int getId() {
        return this.id;
    }
    public Breed getBreed() {
        return this.breed;
    }
    public String getName() {
        return this.name;
    }
    public String getDescription() {
        return this.description;
    }
    public String getOrigin() {
        return this.origin;
    }
    public String getLifespan() {
        return this.lifespan;
    }
}
