package pt.amsi.ipleiria.pet4all.Models;

public class Energy {
    public final static String DB_NAME = "animal";
    private int id;
    private String energy;

    public int getId() {
        return this.id;
    }
    public String getEnergy() {
        return this.energy;
    }

    public Energy(){}

    public Energy(String energy){
        this.energy = energy;
    }


}