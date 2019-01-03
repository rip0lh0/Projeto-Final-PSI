package pt.amsi.ipleiria.pet4all.Models;

public class Animal {
    public final static String TABEL_NAME = "animal";

    private int id;
    private String name;
    private String description;

    public int getId() {
        return id;
    }
    public String getName() {
        return name;
    }
    public String getDescription() {
        return description;
    }

    public Animal(){}
    public Animal(String name, String description){
        this.name = name;
        this.description = description;
    }

    public void update(String name, String description){
        this.name = name;
        this.description = description;
    }

    public void update(String name){
        this.update(name, this.description);
    }

    public static void delete(Animal animal){

    }

    public int generateID(){
        return 0;
    }
}
