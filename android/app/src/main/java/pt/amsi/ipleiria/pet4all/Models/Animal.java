package pt.amsi.ipleiria.pet4all.Models;

public class Animal {
    private int id;
    private String name;
    private String description;

    public Animal(String name, String description){
        this.name = name;
        this.description = description;
    }

    public Animal getAnimal(){
        return this;
    }

    public int getId(){
        return this.id;
    }

    public String getName(){
        return this.name;
    }

    public String getDescription(){
        return this.description;
    }

}
