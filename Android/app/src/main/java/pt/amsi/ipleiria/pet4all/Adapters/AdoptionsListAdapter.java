package pt.amsi.ipleiria.pet4all.Adapters;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.ArrayList;

import pt.amsi.ipleiria.pet4all.Models.Adoption;
import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.Models.Message;
import pt.amsi.ipleiria.pet4all.R;

public class AdoptionsListAdapter extends BaseAdapter{
    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Adoption> arrListAdoption;

    public AdoptionsListAdapter(Context context, ArrayList<Adoption> adoptions) {
        this.context = context;
        this.arrListAdoption = adoptions;
    }

    @Override
    public int getCount() {
        return arrListAdoption.size();
    }

    @Override
    public Adoption getItem(int i) {
        return arrListAdoption.get(i);
    }

    @Override
    public long getItemId(int i) {
        return arrListAdoption.get(i).getId();
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        if(inflater == null)inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);

        if(view == null){
            view = inflater.inflate(R.layout.item_adoption, null);
        }

        AdoptionsListAdapter.ViewHolderList viewHolderList= (AdoptionsListAdapter.ViewHolderList) view.getTag();
        if (viewHolderList == null){
            viewHolderList = new AdoptionsListAdapter.ViewHolderList(view);
            view.setTag(viewHolderList);
        }
        viewHolderList.update(arrListAdoption.get(i));
        return view;
    }

    public void refresh(ArrayList<Adoption> adoptions){
        this.arrListAdoption = adoptions;
        notifyDataSetChanged();
    }

    private class ViewHolderList{
        private ImageView imageViewAnimalImage;
        private TextView textViewAnimalName, textViewUser, textViewLastMessage;

        public ViewHolderList(View view) {
            this.imageViewAnimalImage = view.findViewById(R.id.adoption_animal_image);
            this.textViewAnimalName = view.findViewById(R.id.adoption_animal_name);
            this.textViewUser = view.findViewById(R.id.adoption_user);
            this.textViewLastMessage = view.findViewById(R.id.adoption_message);
        }

        public void update(Adoption adoption){
            this.textViewAnimalName.setText(adoption.getKennelAnimal().getAnimal().getName()+"");
            this.textViewUser.setText(adoption.getArrListMessages().get(0).getUsername()+"");
            this.textViewLastMessage.setText(adoption.getArrListMessages().get(0).getDescription());
        }
    }
}
