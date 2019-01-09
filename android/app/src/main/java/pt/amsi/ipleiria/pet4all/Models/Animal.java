package pt.amsi.ipleiria.pet4all.Models;

import java.sql.Timestamp;
import java.util.Date;

public class Animal {
    public final static String TABEL_NAME = "animal";

    private long id;
    private String name;
    private String description;
    //private String image;
    private int breed;
    private int coat;
    private int size;
    private int energy;
    private String chip;
    private int neutered;
    private int gender;
    private int weight;
    private int age;
    private String created_at;
    private String updated_at;
    private int status;




    public Animal(long id,String name,String description, int breed, int coat, int size, int energy,String chip,int neutered,int gender,int weight,int age,String created_at,String updated_at,int status){
        this.id=id;
        this.name = name;
        this.description = description;
        this.breed= breed;
        this.coat=coat;
        this.size=size;
        this.energy=energy;
        this.chip=chip;
        this.neutered=neutered;
        this.gender=gender;
        this.weight=weight;
        this.age=age;
        this.created_at=created_at;
        this.updated_at=updated_at;
        this.status=status;
        //this.image = image;
    }

    public long getId() {
        return id;
    }
    public String getName() {
        return name;
    }
    public void setName(String name){
        this.name=name;
    }
    public String getDescription() {
        return description;
    }
    public void setDescription(String description) {
        this.description=description;
    }
    public int getBreed() {
        return this.breed;
    }
    public void setId(long id){
        this.id=id;
    }
    public int getCoat() {
        return this.coat;
    }
    public void setCoat(int coat){
        this.coat=coat;
    }
    public int getSize() {
        return this.size;
    }
    public void setSize(int size){
        this.size=size;
    }
    public int getEnergy() {
        return this.energy;
    }
    public void setEnergy(int energy) {
        this.energy=energy;
    }
    public String getChip() {
        return this.chip;
    }
    public void setChip(String chip) {
        this.chip=chip;
    }
    public int getNeutered() {
        return this.neutered;
    }
    public void setNeutered(int neutered) {
        this.neutered=neutered;
    }
    public int getGender() {
        return this.gender;
    }
    public void setGender(int gender) {
        this.gender=gender;
    }
    public int getWeight() {
        return this.weight;
    }
    public void setWeight(int weight) {
        this.weight=weight;
    }
    public int getAge() {
        return this.age;
    }
    public void setAge(int age) {
        this.age=age;
    }
    public String getCreated_at() {
        return this.created_at=created_at.toString();
    }
    public void setCreated_at(String created_at) {
        this.created_at=created_at;
    }
    public String getUpdated_at() {
        return this.updated_at=updated_at.toString();
    }
    public void setUpdated_at(String updated_at) {
        this.updated_at=updated_at;
    }
    public int getStatus() {
        return this.status;
    }
    public void setStatus(int status) {
        this.status=status;
    }



    /*public String getImage(){
        return image;
    }*/


    public static void delete(Animal animal){
    }

    public int generateID(){
        return 0;
    }
}
