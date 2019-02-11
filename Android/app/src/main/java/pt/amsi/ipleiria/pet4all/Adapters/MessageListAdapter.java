package pt.amsi.ipleiria.pet4all.Adapters;

import android.content.Context;
import android.text.Layout;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.ArrayList;

import pt.amsi.ipleiria.pet4all.Helpers.DateHelper;
import pt.amsi.ipleiria.pet4all.Models.Message;
import pt.amsi.ipleiria.pet4all.R;

public class MessageListAdapter extends BaseAdapter {

    private final Context context;
    private LayoutInflater inflater;
    private ArrayList<Message> arrListMessages;

    public MessageListAdapter(Context context, ArrayList<Message> messages){
        this.context = context;
        this.arrListMessages = messages;
    }

    @Override
    public int getCount() {
        return arrListMessages.size();
    }

    @Override
    public Message getItem(int i) {
        return arrListMessages.get(i);
    }

    @Override
    public long getItemId(int i) {
        return arrListMessages.get(i).getId();
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        if(inflater == null) inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        if(view == null) view = inflater.inflate(R.layout.item_message, null);

        ViewHolderList viewHolderList = (ViewHolderList) view.getTag();

        if(viewHolderList == null){
            viewHolderList = new ViewHolderList(view);
            view.setTag(viewHolderList);
        }

        viewHolderList.update(arrListMessages.get(i));

        return view;
    }

    public void refresh(ArrayList<Message> messages){
        this.arrListMessages = messages;
        this.notifyDataSetChanged();
    }

    public class ViewHolderList{
        private TextView textViewUsername;
        private TextView textViewDate;
        private TextView textViewMessage;


        public ViewHolderList (View view){
            this.textViewUsername = view.findViewById(R.id.message_username);
            this.textViewDate = view.findViewById(R.id.message_date);
            this.textViewMessage = view.findViewById(R.id.message_text);
        }

        public void update(Message message) {
            textViewUsername.setText(message.getUsername());
            textViewDate.setText(DateHelper.ConvertDate(message.getCreated_at()));
            textViewMessage.setText(message.getDescription());
        }

    }
}
