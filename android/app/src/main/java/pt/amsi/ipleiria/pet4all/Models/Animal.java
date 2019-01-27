package pt.amsi.ipleiria.pet4all.Models;


public class Animal {
    private static int id;
    private String name;
    private String description;
    private int id_coat; // Coat
    private int id_energy; // Energy
    private int id_size; // Size
    private String chip;
    private float age;
    private char gender;
    private float weight;
    private int neutered;


    public Animal(int id, String name, String description, int id_coat, int id_energy, int id_size, String chip, float age, char gender, float weight, int neutered){
        Animal.id += 1;
        this.name=name;
        this.description=description;
        this.id_coat=id_coat;
        this.id_energy=id_energy;
        this.id_size=id_size;
        this.chip=chip;
        this.age=age;
        this.gender=gender;
        this.weight=weight;
        this.neutered=neutered;
    }

    public static int getId() { return id; }

    public String getName() {
        return name;
    }

    public String getDescription() {
        return description;
    }

    public int getId_coat() {
        return id_coat;
    }

    public int getId_energy() {
        return id_energy;
    }

    public int getId_size() {
        return id_size;
    }

    public String getChip() {
        return chip;
    }

    public float getAge() {
        return age;
    }

    public char getGender() {
        return gender;
    }

    public float getWeight() {
        return weight;
    }

    public int getNeutered() {
        return neutered;
    }

}
