package pt.amsi.ipleiria.pet4all.Listeners;

import java.util.ArrayList;

import pt.amsi.ipleiria.pet4all.Models.Animal;

public interface AnimalsListener {
    void onRefreshAnimalsList(ArrayList<Animal> animalsList);
    void onUpdateAnimalsListDB(Animal animal, int action);
}
