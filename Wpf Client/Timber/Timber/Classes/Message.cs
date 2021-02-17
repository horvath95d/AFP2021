using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Timber.Classes
{
    public class Message
    {
        public Message(int UserId, string Text)
        {
            this.UserId = UserId;
            this.Text = Text;
            TimeDate = DateTime.Now;
            Id = idCounter;
            idCounter++;
        }

        private static int idCounter = 0;
        public int Id {get;}

        public int UserId { get; set; }

        public string Text { get; set; }

        //public File SentFile { get; set; }

        public DateTime TimeDate { get; set; }

        public override bool Equals(object obj)
        {
            if (obj == null)
            {
                return false;
            }
            if (!(obj is Message))
            {
                return false;
            }
            return this.Text == ((Message)obj).Text
                && this.Id == ((Message)obj).Id;
        }
    }
}
