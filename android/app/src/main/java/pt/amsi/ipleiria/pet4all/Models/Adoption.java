package pt.amsi.ipleiria.pet4all.Models;

import java.util.Date;

public class Adoption {
    public final static String DB_NAME = "animal";

    private int id;
    private Adopter adopter;
    private Animal animal;
    private Date created_at;
    private Date updated_at;
    private String description;
    private int state;

    public int getId() {
        return this.id;
    }
    public Adopter getAdopter() {
        return this.adopter;
    }
    public Animal getAnimal() {
        return this.animal;
    }
    public Date getCreated_at() {
        return this.created_at;
    }
    public Date getUpdated_at() {
        return this.updated_at;
    }
    public String getDescription() {
        return this.description;
    }
    public int getState() {
        return this.state;
    }
}