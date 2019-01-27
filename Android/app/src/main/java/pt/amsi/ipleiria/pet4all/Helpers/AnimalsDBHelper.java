package pt.amsi.ipleiria.pet4all.Helpers;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;

import pt.amsi.ipleiria.pet4all.Models.Animal;

public class AnimalsDBHelper extends SQLiteOpenHelper {
    private static final int DB_VERSION = 1;
    private static final String DB_NAME = "animalsDB";

    private static  final String TABLE_NAME = "Livro";
    private static final String TABLE_COMMON_ID = "id";
    private static final String TABLE_ANIMAL_NAME = "name";
    private static final String TABLE_ANIMAL_DESCRIPTION = "description";
    private static final String TABLE_ANIMAL_COAT_SIZE = "coat_size";
    private static final String TABLE_ANIMAL_ENERGY  = "energy";
    private static final String TABLE_ANIMAL_SIZE  = "size";
    private static final String TABLE_ANIMAL_CHIP  = "chip";
    private static final String TABLE_ANIMAL_AGE  = "age";
    private static final String TABLE_ANIMAL_GENDER  = "gender";
    private static final String TABLE_ANIMAL_WEIGHT  = "weight";
    private static final String TABLE_ANIMAL_NEUTERED  = "neutered";
    private static final String TABLE_ANIMAL_ID_KENNEL  = "id_kennel";
    private static final String TABLE_ANIMAL_CREATED_AT  = "created_at";


    private final SQLiteDatabase database;

    public AnimalsDBHelper(Context context){
        super(context, DB_NAME, null, DB_VERSION);
        this.database = this.getWritableDatabase();
    }


    @Override
    public void onCreate(SQLiteDatabase db) {
        String createAnimalTable = "" +
                "CREATE TABLE IF NOT EXISTS " + TABLE_NAME +
                "(" + TABLE_COMMON_ID + " INTEGER PRIMARY KEY AUTOINCREMENT, " +
                TABLE_ANIMAL_NAME +  " TEXT NOT NULL, " +
                TABLE_ANIMAL_DESCRIPTION + " TEXT, " +
                TABLE_ANIMAL_COAT_SIZE + " TEXT, " +
                TABLE_ANIMAL_ENERGY + " TEXT, " +
                TABLE_ANIMAL_SIZE + " TEXT, " +
                TABLE_ANIMAL_CHIP + " TEXT UNIQUE, " +
                TABLE_ANIMAL_AGE + " REAL, " +
                TABLE_ANIMAL_GENDER + " CHARACTER NOT NULL, " +
                TABLE_ANIMAL_WEIGHT + " REAL, " +
                TABLE_ANIMAL_NEUTERED + " TINYINT NOT NULL, " +
                TABLE_ANIMAL_ID_KENNEL + " INTEGER NOT NULL, " +
                TABLE_ANIMAL_CREATED_AT + " TEXT NOT NULL " + ");";
        db.execSQL(createAnimalTable);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_NAME);
        this.onCreate(db);
    }


    public Animal addAnimalDB(Animal animal){
        ContentValues values = new ContentValues();

        values.put(TABLE_ANIMAL_NAME, animal.getName());
        values.put(TABLE_ANIMAL_DESCRIPTION, animal.getDescription());
        values.put(TABLE_ANIMAL_COAT_SIZE, animal.getCoat());
        values.put(TABLE_ANIMAL_ENERGY, animal.getEnergy());
        values.put(TABLE_ANIMAL_SIZE, animal.getSize());
        values.put(TABLE_ANIMAL_CHIP, animal.getChip());
        values.put(TABLE_ANIMAL_AGE, animal.getAge());
        values.put(TABLE_ANIMAL_GENDER, animal.getGender());
        values.put(TABLE_ANIMAL_WEIGHT, animal.getWeight());
        values.put(TABLE_ANIMAL_NEUTERED, animal.getNeutered());
        values.put(TABLE_ANIMAL_ID_KENNEL, animal.getId_kennel());
        values.put(TABLE_ANIMAL_CREATED_AT, animal.getCreated_at());

        long id = this.database.insert(TABLE_NAME, null, values);

        if(id > -1){
            animal.setId(id);
            return animal;
        }

        return null;
    }

    public boolean editAnimalDB(Animal animal){
        ContentValues values = new ContentValues();

        values.put(TABLE_ANIMAL_NAME, animal.getName());
        values.put(TABLE_ANIMAL_DESCRIPTION, animal.getDescription());
        values.put(TABLE_ANIMAL_COAT_SIZE, animal.getCoat());
        values.put(TABLE_ANIMAL_ENERGY, animal.getEnergy());
        values.put(TABLE_ANIMAL_SIZE, animal.getSize());
        values.put(TABLE_ANIMAL_CHIP, animal.getChip());
        values.put(TABLE_ANIMAL_AGE, animal.getAge());
        values.put(TABLE_ANIMAL_GENDER, animal.getGender());
        values.put(TABLE_ANIMAL_WEIGHT, animal.getWeight());
        values.put(TABLE_ANIMAL_NEUTERED, animal.getNeutered());
        values.put(TABLE_ANIMAL_ID_KENNEL, animal.getId_kennel());
        values.put(TABLE_ANIMAL_CREATED_AT, animal.getCreated_at());

        return this.database.update(TABLE_NAME,  values, "id = ?", new String[]{"" + animal.getId()}) > 0;
    }

    public boolean removeAnimalDB(Long idAnimal){
        return this.database.delete(TABLE_NAME, "id = ?", new String[]{"" + idAnimal}) == 1;
    }

    public void removeAllAnimalsDB(){
        this.database.delete(TABLE_NAME, null, null);
    }

    public ArrayList<Animal> getAllAnimalsDB(){
        ArrayList<Animal> animals = new ArrayList<>();

        Cursor cursor = this.database.query(
                TABLE_NAME,
                new String[]{
                        TABLE_COMMON_ID,
                        TABLE_ANIMAL_NAME,
                        TABLE_ANIMAL_DESCRIPTION,
                        TABLE_ANIMAL_COAT_SIZE,
                        TABLE_ANIMAL_ENERGY,
                        TABLE_ANIMAL_SIZE,
                        TABLE_ANIMAL_CHIP,
                        TABLE_ANIMAL_AGE,
                        TABLE_ANIMAL_GENDER,
                        TABLE_ANIMAL_WEIGHT,
                        TABLE_ANIMAL_NEUTERED,
                        TABLE_ANIMAL_ID_KENNEL,
                        TABLE_ANIMAL_CREATED_AT
                }, null, null, null, null, null);

        if(cursor.moveToFirst()){
            do {
                Animal auxAnimal = new Animal(
                        cursor.getLong(0),
                        cursor.getString(1),
                        cursor.getString(2),
                        cursor.getString(3),
                        cursor.getString(4),
                        cursor.getString(5),
                        cursor.getString(6),
                        cursor.getInt(7),
                        cursor.getString(8).charAt(0),
                        cursor.getDouble(9),
                        cursor.getInt(10),
                        cursor.getInt(11),
                        cursor.getString(12),
                        null);
                auxAnimal.setId(cursor.getLong(0));
                animals.add(auxAnimal);
            }while (cursor.moveToNext());
        }
        return animals;
    }
}
