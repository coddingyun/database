import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns

access_log = pd.read_csv('/var/log/apache2/access_log', delimiter=' ')
access_log.columns = ['ip', 'dash1', 'dash2', 'time', 'timezone', 'request', 'status', 'size', 'referrer', 'user_agent']
print(access_log['time'].head())
access_log.drop(['dash1', 'dash2'], axis=1, inplace=True)
access_log['time'] = pd.to_datetime(access_log['time'], format='[%d/%b/%Y:%H:%M:%S')
access_log['timezone'] = access_log['timezone'].str.replace(']', '')
access_log['status'] = access_log['status'].astype(int)
access_log['referrer'] = access_log['referrer'].str.replace('"', '')
access_log['user_agent'] = access_log['user_agent'].str.replace('"', '')
access_log['user_agent'] = access_log['user_agent'].str.split(' ').str[0]
access_log['request'] = access_log['request'].str.replace('"', '')
access_log['request'] = access_log['request'].str.split(' ')
access_log['method'] = access_log['request'].str[0]
access_log['url'] = access_log['request'].str[1]
access_log['protocol'] = access_log['request'].str[2]
access_log.drop(['request'], axis=1, inplace=True)
access_log['url'] = access_log['url'].str.replace('http://', '')
access_log.to_csv('access_log.csv', index=False)
#print(access_log)
df = access_log[access_log['url'].str.contains('gim', na=False)]
df = df[df['url'].str.contains('php|html', na=False)]
df = df[df['user_agent'].str.contains('/', na=False)]
print(df['user_agent'])
# f = open('/var/log/apache2/access_log')
# log = f.read() 
#print(log)
#make a line plot of the number of accesses to each page depending on the time

# make diagram of how often each page is accessed by whom and when and what browser they are using.
df.plot(x='time', y='ip', kind='scatter')
plt.tight_layout()
plt.xticks(rotation=45)
plt.show()
plt.savefig('access_log_ip_address.png')
df.plot(x='time', y='url', kind='scatter')
plt.tight_layout()
plt.xticks(rotation=45)
plt.show()
plt.savefig('access_log_url.png')
df.plot(x='time', y='user_agent', kind='scatter')
plt.tight_layout()
plt.xticks(rotation=45)
plt.show()
plt.savefig('access_log_user_agent.png')
# make diagram of what errors and who originated errors and when.

# error_log = open('/var/log/apache2/error_log', 'r')
# error_log = error_log.read()
# print(error_log)
error_log = pd.read_csv('/var/log/apache2/error_log', sep='\]', engine='python' ,error_bad_lines=False)
error_log.columns = ['time', 'error', 'pid', 'ip','referrer']
error_log.drop(['pid'], axis=1, inplace=True)
error_log['time'] = error_log['time'].str.replace(']', '')
error_log['time'] = pd.to_datetime(error_log['time'], format='[%a %b %d %H:%M:%S.%f %Y')
error_log['error'] = error_log['error'].str.replace('[', '')
error_log['ip'] = error_log['ip'].str.replace('[', '')
error_log['ip'] = error_log['ip'].str.replace('client ', '')
error_log['ip'] = error_log['ip'].str.split(':').str[0]
error_log.to_csv('error_log.csv', index=False)
print(error_log['ip'].head())
print(error_log['referrer'].head())

df2 = error_log[error_log['referrer'].str.contains('gim', na=False)]
print(df2)
df2.plot(x='time', y='error', kind='scatter')
plt.tight_layout()
plt.xticks(rotation=45)
plt.show()
plt.savefig('error_log_error.png')
df2.plot(x='time', y='ip', kind='scatter')
plt.tight_layout()
plt.xticks(rotation=45)
plt.show()
plt.savefig('error_log_ip.png')
