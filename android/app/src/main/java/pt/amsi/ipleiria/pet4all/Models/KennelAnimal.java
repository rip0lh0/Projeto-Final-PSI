package pt.amsi.ipleiria.pet4all.Models;

import java.util.Date;

public class KennelAnimal {
    public final static String DB_NAME = "animal";

    private int id;
    private Animal animal;
    private Kennel kennel;
    private Date created_at;
    private Date updated_at;
    private int state;


    public int getId() {
        return this.id;
    }
    public Animal getAnimal() {
        return this.animal;
    }
    public Kennel getKennel() {
        return this.kennel;
    }
    public Date getCreated_at() {
        return this.created_at;
    }
    public Date getUpdated_at() {
        return this.updated_at;
    }
    public int getState() {
        return this.state;
    }
}