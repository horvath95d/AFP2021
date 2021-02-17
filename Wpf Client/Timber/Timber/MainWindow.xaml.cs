using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;
using Timber.Classes;

namespace Timber
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        public MainWindow()
        {
            InitializeComponent();
            OnlineUsers.Add("Seres Péter");
            OnlineUsers.Add("Kerepesi Gergő");
            OnlineUsers.Add("Horváth Dániel");
            OnlineUsers.Add("Szalóki Dávid");
            Messages.Add(new Message(0, "This is a demo"));
            Messages.Add(new Message(0, "It's a work in progress."));
            RefreshOnlineUsers();
            RefreshMessages();
        }

        public List<Message> Messages = new List<Message>();
        public List<string> OnlineUsers = new List<string>();

        private void button_Click(object sender, RoutedEventArgs e)
        {
            SendMessage();
        }

        private void RefreshMessages()
        {
            lock (typeof(MainWindow))
            {
                MsgListBox.Items.Clear();
                for (int i = Messages.Count - 1; i >= 0; i--)
                {
                    MsgListBox.Items.Insert(0, Messages[i]);
                }
                MsgListBox.SelectedItem = null;
            }
            ScrollToBottom();
        }

        private void RefreshOnlineUsers()
        {
            lock(typeof(MainWindow))
            {
                UserListBox.Items.Clear();
                for (int i = 0; i < OnlineUsers.Count - 1; i++)
                {
                    UserListBox.Items.Add(OnlineUsers[i]);
                }
            }
        }

        private void SendMessage()
        {
            lock (typeof(MainWindow))
            {
                if (textBox.Text != "")
                    Messages.Add(new Message(0, textBox.Text));
                RefreshMessages();
                textBox.Text = "";
            }
        }


        private void ScrollToBottom()
        {
            lock (typeof(MainWindow))
            {
                object LastMessage = MsgListBox.Items[MsgListBox.Items.Count - 1];
                MsgListBox.ScrollIntoView((object)LastMessage);
            }
        }
        
        private void EnterPress(object sender, KeyEventArgs e)
        {
            if (e.Key == Key.Return)
            {
                SendMessage();
            }
        }
    }
}
