package pt.amsi.ipleiria.pet4all.Models;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;

public class AnimalDBHelper extends SQLiteOpenHelper {
    private  static final int DB_VERSION = 1;
    private static final String DB_NAME="pet4all";
    private static  final String TABLE_NAME = "Animal";
    private static final String TABLE_COMMON_ID = "id";
    private static final String TABLE_ANIMAL_NAME = "name";
    private static final String TABLE_ANIMAL_DESC = "description";
    private static final String TABLE_ANIMAL_COAT = "id_coat";
    private static final String TABLE_ANIMAL_ENERGY = "id_energy";
    private static final String TABLE_ANIMAL_SIZE = "id_size";
    private static final String TABLE_ANIMAL_CHIP = "chip";
    private static final String TABLE_ANIMAL_AGE = "age";
    private static final String TABLE_ANIMAL_GENDER = "gender";
    private static final String TABLE_ANIMAL_WEIGHT = "weight";
    private static final String TABLE_ANIMAL_NEUTERED = "neutered";
    private static final String TABLE_ANIMAL_CREATED = "create_at";
    private static final String TABLE_ANIMAL_UPDATED = "updated_at";
    private static final String TABLE_ANIMAL_STATUS = "status";
    //private static final

    private final SQLiteDatabase database;

    public AnimalDBHelper(Context context){
        super(context,DB_NAME,null,DB_VERSION);
        this.database=this.getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String createAnimalTable = "CREATE TABLE IF NOT EXISTS " + TABLE_NAME +
                "(" + TABLE_COMMON_ID + " INTEGER PRIMARY KEY AUTOINCREMENT, " +
                TABLE_ANIMAL_NAME +  " TEXT NOT NULL, " +
                TABLE_ANIMAL_DESC + " TEXT NOT NULL, " +
                TABLE_ANIMAL_COAT + " INTEGER NOT NULL, " +
                TABLE_ANIMAL_ENERGY + " INTEGER NOT NULL, " +
                TABLE_ANIMAL_SIZE + " INTEGER NOT NULL, " +
                TABLE_ANIMAL_CHIP + " INTEGER NOT NULL, " +
                TABLE_ANIMAL_AGE + " FLOAT NOT NULL, " +
                TABLE_ANIMAL_GENDER + " INTEGER NOT NULL, " +
                TABLE_ANIMAL_WEIGHT + " FLOAT NOT NULL, " +
                TABLE_ANIMAL_NEUTERED + " TINYINT NOT NULL, " +
                TABLE_ANIMAL_CREATED + " TIMESTAMP NOT NULL, " +
                TABLE_ANIMAL_UPDATED + " TIMESTAMP NOT NULL, " +
                TABLE_ANIMAL_STATUS + " TEXT NOT NULL " + ");";
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
        values.put(TABLE_ANIMAL_DESC, animal.getDescription());
        values.put(TABLE_ANIMAL_COAT, String.valueOf(animal.getCoat()));
        values.put(TABLE_ANIMAL_ENERGY, String.valueOf(animal.getEnergy()));
        values.put(TABLE_ANIMAL_SIZE, String.valueOf(animal.getSize()));
        values.put(TABLE_ANIMAL_CHIP, animal.getChip());
        values.put(TABLE_ANIMAL_AGE, animal.getAge());
        values.put(TABLE_ANIMAL_GENDER, animal.getGender());
        values.put(TABLE_ANIMAL_WEIGHT, animal.getWeight());
        values.put(TABLE_ANIMAL_NEUTERED, animal.getNeutered());
        values.put(TABLE_ANIMAL_CREATED, String.valueOf(animal.getCreated_at()));
        values.put(TABLE_ANIMAL_UPDATED, String.valueOf(animal.getUpdated_at()));
        values.put(TABLE_ANIMAL_STATUS, animal.getStatus());
        long id = this.database.insert(TABLE_NAME, null, values);
        if(id > -1){
            animal.setId(id);
            return animal;
        }
        return null;
    }

    public boolean editAnimalDB(Animal animal) {
        ContentValues values = new ContentValues();
        values.put(TABLE_ANIMAL_NAME, animal.getName());
        values.put(TABLE_ANIMAL_DESC, animal.getDescription());
        values.put(TABLE_ANIMAL_COAT, String.valueOf(animal.getCoat()));
        values.put(TABLE_ANIMAL_ENERGY, String.valueOf(animal.getEnergy()));
        values.put(TABLE_ANIMAL_SIZE, String.valueOf(animal.getSize()));
        values.put(TABLE_ANIMAL_CHIP, animal.getChip());
        values.put(TABLE_ANIMAL_AGE, animal.getAge());
        values.put(TABLE_ANIMAL_GENDER, animal.getGender());
        values.put(TABLE_ANIMAL_WEIGHT, animal.getWeight());
        values.put(TABLE_ANIMAL_NEUTERED, animal.getNeutered());
        values.put(TABLE_ANIMAL_CREATED, String.valueOf(animal.getCreated_at()));
        values.put(TABLE_ANIMAL_UPDATED, String.valueOf(animal.getUpdated_at()));
        values.put(TABLE_ANIMAL_STATUS, animal.getStatus());
        return this.database.update(TABLE_NAME, values, "id = ?", new String[]{"" + animal.getId()}) > 0;
    }
        public boolean removeAnimalDB(Long idAnimal){
            return this.database.delete(TABLE_NAME, "id = ?", new String[]{"" + idAnimal}) == 1;
        }

        public void removeAllAnimalsDB(){
        this.database.delete(TABLE_NAME, null, null);
        }

    public ArrayList<Animal> getAllAnimalsDB(){
        ArrayList<Animal> animals = new ArrayList<>();

        Cursor cursor = this.database.query(TABLE_NAME,new String[]{TABLE_COMMON_ID,
                TABLE_ANIMAL_NAME,
                TABLE_ANIMAL_DESC,
                TABLE_ANIMAL_COAT,
                TABLE_ANIMAL_ENERGY,
                TABLE_ANIMAL_SIZE,
                TABLE_ANIMAL_CHIP,
                TABLE_ANIMAL_AGE,
                TABLE_ANIMAL_GENDER,
                TABLE_ANIMAL_WEIGHT,
                TABLE_ANIMAL_NEUTERED,
                TABLE_ANIMAL_CREATED,
                TABLE_ANIMAL_UPDATED,
                TABLE_ANIMAL_STATUS }, null, null, null, null, null);

        if(cursor.moveToFirst()){
            do {
                Animal auxAnimal = new Animal(
                        cursor.getLong(0),
                        cursor.getString(1),
                        cursor.getString(2),
                        //cursor.getInt(3),
                        cursor.getInt(3),
                        cursor.getInt(4),
                        cursor.getInt(5),
                        cursor.getString(6),
                        cursor.getInt(7),
                        cursor.getInt(8),
                        cursor.getInt(9),
                        cursor.getInt(10),
                        cursor.getString(11),
                        cursor.getString(12),
                        cursor.getInt(13));
                auxAnimal.setId(cursor.getLong(0));
                animals.add(auxAnimal);
            }while (cursor.moveToNext());
        }
        return animals;
    }

}
