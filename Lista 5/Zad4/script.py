import socket

class DNSQuery:
  def __init__(self, data):
    self.data=data
    self.domain=''

    kind = (ord(data[2]) >> 3) & 15   # Opcode bits
    if kind == 0:                     # Standard query
      ini=12
      len=ord(data[ini])
      while len != 0:
        self.domain+=data[ini+1:ini+len+1]+'.'
        ini+=len+1
        len=ord(data[ini])

  def answer(self, ip):
    packet=''
    if self.domain:
      packet+=self.data[:2] + "\x81\x80"
      packet+=self.data[4:6] + self.data[4:6] + '\x00\x00\x00\x00'   # Questions and Answers Counts
      packet+=self.data[12:]                                         # Original Domain Name Question
      packet+='\xc0\x0c'                                             # Pointer to domain name
      packet+='\x00\x01\x00\x01\x00\x00\x00\x3c\x00\x04'             # Response type, ttl and resource data length -> 4 bytes
      packet+=str.join('',map(lambda x: chr(int(x)), ip.split('.'))) 
    return packet

if __name__ == '__main__':
  ip='192.168.1.1'
  print 'pyminifakeDNS:: dom.query. 60 IN A %s' % ip
  
  udps = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
  udps.bind(('',53))
  
  try:
    while 1:
      data, addr = udps.recvfrom(1024)
      p=DNSQuery(data)
      udps.sendto(p.answer(ip), addr)
      print 'Answer: %s -> %s' % (p.domain, ip)
  except KeyboardInterrupt:
    udps.close()